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
	protected $primaryKey           = 'id_hh';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"id_hh",
		"FK_hotel",
		"FK_habitacion_acomo",
		"cantidad"
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
			->select('*')
			->join('hotel AS H', 'FK_hotel = H.id_h')
			->join('habitacion_acomodacion AS HA', 'FK_habitacion_acomo = HA.id_hc')
			->join('tipo_habitacion AS TH', 'HA.FK_tipo_habitacion = TH.id_habi')
			->join('acomodacion AS A', 'HA.FK_acomodacion = A.id_acom')
			->get()
			->getResult();
			//->getCompiledSelect();
			//print_r($querye);
		return $querye;
	}

	public function get_t_habitaciones($fk_hotel)
	{
		$querye = $this->table($this->table)
			->selectSum('cantidad')
			->where('FK_hotel', $fk_hotel)
			->groupBy('FK_hotel')
			->get()
			->getResultArray();
			//->getCompiledSelect();
			//		print_r($querye);
		return $querye;
	}

	//funciones
	public function exist_hh($data)
	{
		$querye = $this->table($this->table)
			->where('FK_hotel', $data->FK_hotel)
			->where('FK_habitacion_acomo', $data->FK_habitacion_acomo)
			->countAllResults();

		if ($querye >  0) {
			$querye = true;
		} else {
			$querye = false;
		}
		return $querye;
	}

	public function insert_hh($data)
	{
		$query = $this->db->table($this->table)->insert($data);
		//imprimir el query
		//$data['lastQuery'] =  $this->db->getLastQuery();
		//print_r($data);
		return $query ? true : false;
	}

}