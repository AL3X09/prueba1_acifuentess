<?php 
namespace App\Models;

use CodeIgniter\Model;

class HabitacionAcomodaModel extends Model{
	
	function __construct()
    {
        parent::__construct();
    }

    protected $DBGroup              = 'default';
	protected $table                = 'habitacion_acomodacion';
	protected $primaryKey           = 'id_hc';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"id_hc",
		"FK_tipo_habitacion",
		"FK_acomodacion",
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
			->join('tipo_habitacion AS TH', 'FK_tipo_habitacion = TH.id_habi')
			->join('acomodacion AS A', 'FK_acomodacion = A.id_acom')
			->get()
			->getResult();
			//->getCompiledSelect();
			//print_r($querye);
		return $querye;
	}

	/*public function get_all()
	{
		$querye = $this->table($this->table)
			->get()
			->getResult();
		return $querye;
	}*/

	//funciones
	public function exist_hc($data)
	{
		$querye = $this->table($this->table)
			->where('FK_tipo_habitacion', $data->FK_tipo_habitacion)
			->where('FK_acomodacion', $data->FK_acomodacion)
			->countAllResults();

		if ($querye >  0) {
			$querye = true;
		} else {
			$querye = false;
		}
		return $querye;
	}

	public function insert_hc($data)
	{
		$query = $this->db->table($this->table)->insert($data);
		return $query ? true : false;
	}

}