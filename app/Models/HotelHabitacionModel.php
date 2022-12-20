<?php 
namespace App\Models;

use CodeIgniter\Model;

class HotelHabitacionModel extends Model{
	
	function __construct()
    {
        parent::__construct();
    }

    protected $DBGroup              = 'default';
	protected $table                = 'hotel_habitacion';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"id",
		"fk_hotel",
		"fk_tipo_habitacion",
		"cantidad_h"
	];

    // Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

	public function get_all()
	{
		$querye = $this->table($this->table)
			->get()
			->getResult();
		return $querye;
	}

	//funciones
	public function exist_hh($data)
	{
		$querye = $this->table($this->table)
			->where('nombre', $data->nombre)
			->countAllResults();

		if ($querye >  0) {
			$querye = true;
		} else {
			$querye = false;
		}
		return $querye;
	}

	public function get_thabitaciones($fk_hotel)
    {
        $querye = $this->table($this->table)
				  ->distinct();
				  ->select('thabitaciones')
				  ->join('hotel', 'hotel.id = '.$this->table->fk_hotel, 'left')
				  ->where($this->table->fk_hotel, $fk_hotel)
        return $querye;
    }

	public function insert_hh($data)
	{
		$query = $this->db->table($this->table)->insert($data);
		return $query ? true : false;
	}

}