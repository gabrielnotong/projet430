<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FakeUser extends CI_Controller
{
    /**
     * @var User_model $user_model
     */
    public $user_model;

    function __construct()
    {
        parent::__construct();
        $this->faker = Faker\Factory::create();
        $this->load->model('user_model');
    }

    function index()
    {
        $data['users'] = $this->user_model->get();
        $this->load->view('users', $data);
    }
    /**
     * seed local database
     */
    function seed()
    {
        $this->_truncate_db();
        $this->_seed_users(25);
    }

    /**
     * seed users
     *
     * @param int $limit
     */
    function _seed_users($limit)
    {
        for ($i = 0; $i < $limit; $i++) {


            $data = array(
                'username' => $this->faker->unique()->userName, // get a unique nickname
                'password' => md5('12345'), // run this via your password hashing function
                'firstname' => $this->faker->firstName,
                'lastName' => $this->faker->lastName,
                'gender' => rand(0, 1) ? 'male' : 'female',
                'bio' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vel, rem, est! Omnis perferendis, nisi obcaecati modi aliquam, neque! Culpa quia, animi itaque numquam praesentium nemo ut repudiandae eius, debitis nulla.',
                'address' => $this->faker->streetAddress,
                'city' => $this->faker->city,
                'state' => $this->faker->state,
                'country' => $this->faker->country,
                'postcode' => $this->faker->postcode,
                'email' => $this->faker->email,
                'email_verified' => mt_rand(0, 1) ? '0' : '1',
                'phone' => $this->faker->phoneNumber,
                'birthdate' => $this->faker->dateTimeThisCentury->format('Y-m-d H:i:s'),
                'registration_date' => $this->faker->dateTimeThisYear->format('Y-m-d H:i:s'),
                'ip_address' => mt_rand(0, 1) ? $this->faker->ipv4 : $this->faker->ipv6,
                'status' => $i === 0 ? true : rand(0, 1),
            );

            $this->user_model->insert($data);
        }
        $this->session->set_flashdata('message', 'Database Seeds Successfully 25 Records Added In Database');
        redirect('user/index', 'location');
    }

    private function _truncate_db()
    {
        $this->user_model->truncate();
    }

}
