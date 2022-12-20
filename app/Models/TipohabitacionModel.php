<?php 
namespace App\Models;

use CodeIgniter\Model;

class TipohabitacionModel extends Model{
	
	function __construct()
    {
        parent::__construct();
    }

    protected $DBGroup              = 'default';
	protected $table                = 'tipo_habitacion';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		"id",
		"tipo"
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
	public function exist_t($data)
	{
		$querye = $this->table($this->table)
			->where('tipo', $data->tipo)
			->countAllResults();

		if ($querye >  0) {
			$querye = true;
		} else {
			$querye = false;
		}
		return $querye;
	}

	public function insert_t($data)
	{
		$query = $this->db->table($this->table)->insert($data);
		return $query ? true : false;
	}

}