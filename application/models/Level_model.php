<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * TODO: factoriser les méthodes add, delete, edit dans un BaseModel, comme ça uniquement les BaseModel sera
 * TODO: chargé au niveau du base controller
 * Class Level_model
 */
class Level_model extends CI_Model
{
    /**
     * @return array $result : This is result
     */
    function getAll()
    {
        $this->db->select('*');
        $this->db->from('levels');
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * @param int $levelId
     * @return null|object $result
     */
    function getLevelById(int $levelId): ?object
    {
        $this->db->select('les.*');
        $this->db->from('levels as les');
        $this->db->where('les.id', $levelId);
        $query = $this->db->get();

        if (!$query->num_rows()) {
            return null;
        }

        return $query->result()[0];
    }


    /**
     * @param $levelInfo
     * @return mixed
     */
    function add(array $levelInfo): int
    {
        $this->db->trans_start();
        $this->db->insert('levels', $levelInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

    /**
     * @param array $levelInfo
     * @param int $levelId
     * @return bool
     */
    function update(array $levelInfo, int $levelId): bool
    {
        $this->db->where('id', $levelId);
        $this->db->update('levels', $levelInfo);

        return true;
    }

    /**
     * @param int $levelId
     * @return bool
     */
    function delete(int $levelId): bool
    {
        $this->db->where('id', $levelId);
        $this->db->delete('levels');
        return true;
    }


    /**
     * VERIFY IF THE SELECTED LEVEL IS FREE FOR THIS PERIOD
     * @param int $levelId
     * @param array $events
     * @return bool
     */
    function isCollisionDetected(int $levelId, array $events): bool
    {
        $unavailableLevels = $this->getUnavailableLevelsForWithinAPeriod($events);
        $isCollision = false;
        foreach ($unavailableLevels as $unavailableLevel) {
            if (intval($unavailableLevel["level_id"]) === $levelId) {
                $isCollision = true;
                break;
            }
        }

        return $isCollision;
    }

    /**
     * GET THE SCHOOL LEVEL UNAVAILABLE WITHIN A PERIOD
     * @param array $events
     * @return array
     */
    public function getUnavailableLevelsForWithinAPeriod(array $events)
    {
        $this->db->select("ra.level_id");
        $this->db->from("resource_allocation as ra");

        $min = $events['start_date'];
        $max = $events['end_date'];

        $where_period = "((ra.start_date <= '{$min}' AND '{$min}' <= ra.end_date) OR ";
        $where_period .= "('{$min}' <= ra.start_date AND ra.start_date <= '{$max}') OR ";
        $where_period .=  "('{$min}' <= ra.end_date AND ra.end_date <= '{$max}'))";

        $this->db->where('ra.level_id', $events['level_id']);
        $this->db->where('ra.semester_id', $events['semester_id']);
        $this->db->where($where_period);

        return  $this->db->get()->result_array();
    }

}

