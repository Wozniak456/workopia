<?php

namespace App\Controllers;

use Framework\Database;

class ListingController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    public function index()
    {
        $listings = $this->db->query('select * from listings');
        $listings = $listings->fetchAll();

        loadView('listings/index', [
            'listings' => $listings
        ]);
    }

    public function create()
    {
        loadView('listings/create');
    }

    public function show($params)
    {
        $id = $params['id'] ?? '';

        $params = [
            'id' => $id
        ];

        $listing = $this->db->query('select * from listings where id = :id', $params);

        $listing = $listing->fetch();

        //chech if exist
        if (!$listing) {
            ErrorController::notFound('Listing not found');
            return;
        }

        // inspect($listing);

        loadView('listings/show', [
            'listing' => $listing
        ]);
    }
}
