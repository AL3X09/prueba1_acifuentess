<?php 
namespace App\Models;

use CodeIgniter\Model;

class HotelModel extends Model{
	
	function __construct()
    {
        parent::__construct();
    }

    protected $DBGroup              = 'default';
	protected $table                = 'hotel';
	protected $primaryKey           = 'id_h';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'id_h',
		"nombre_h", 
		"ciudad", 
		"direccion", 
		"nit",
		"num_habitaciones"
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

	

	public function exist_name($name)
    {
        $querye = $this->table($this->table)
					->where('nombre', $name)
					->countAllResults();
		
        if($querye >  0){
            $querye = true;
        } else {
            $querye = false;
        }
        return $querye;
    }

	public function get_thabitaciones($fk_hotel)
    {
        $querye = $this->table($this->table)
				  ->distinct()
				  ->select('num_habitaciones')
				  ->where('id', $fk_hotel);
        return $querye;
    }

}