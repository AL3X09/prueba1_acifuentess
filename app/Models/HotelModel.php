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
		"t_habitaciones"
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

	/*public function get_all()
	{
		$querye = $this->table($this->table)
			->join('hotel_habitacion AS HH', 'HH.FK_hotel = id_h')
			->join('habitacion_acomodacion AS AH', 'HH.FK_habitacion_acomo = AH.id_hc')
			->join('tipo_habitacion AS TH', 'AH.FK_tipo_habitacion = TH.id_habi')
			->join('acomodacion AS A', 'AH.FK_acomodacion = A.id_acom')
			->get()
			->getResult();
		return $querye;
	}*/

	public function get_all()
	{
		$querye = $this->table($this->table)
			->get()
			->getResult();
		return $querye;
	}

	public function exist_h($nombre)
    {
        $querye = $this->table($this->table)
					->where('nombre_h', $nombre)
					->countAllResults();
        if($querye >  0){
            $querye = true;
        } else {
            $querye = false;
        }
        return $querye;
    }

	public function get_thabitacion($fk_hotel)
    {
        $querye = $this->table($this->table)
				  ->distinct()
				  ->select('t_habitaciones')
				  ->where('id_h', $fk_hotel)
				  ->get()
				  ->getResultArray();
				  //->getResult();
				  //->getCompiledSelect();
					//print_r($querye);
				  
				  //->getUnbufferedRow();
        return $querye;
    }
	
	public function insert_h($data)
	{
		$query = $this->db->table($this->table)->insert($data);
		return $query ? true : false;
		//$insert_id = $this->db->insert_id();
		//return  $insert_id;
	}

}