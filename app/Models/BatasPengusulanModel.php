<?php

namespace App\Models;

use CodeIgniter\Model;

class BatasPengusulanModel extends Model
{
    protected $table = 'tbl_batas_pengusulan';
    protected $useTimestamps = 'true';
    protected $allowedFields = ['waktu','created_at', 'updated_at'];
    
    
}