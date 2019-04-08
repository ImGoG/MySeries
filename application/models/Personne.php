<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Personne extends CI_Model {

  function __construct()
  {
      parent::__construct();
      $this->load->library('session');
      $this->load->library('my_queries');
  }


  public function get($id){
    $query = $this->my_queries->query('get_person', ['id' => $id]);
    return $query->first_row();
  }

  public function get_actor_role($id){
    $query = $this->my_queries->query('get_actor_role', ['id' => $id]);
    return $query->result_array();
  }

  public function get_series($id){
    $role = $this->get_actor_role($id);
    $result = [];
    for($i=0; $i<count($role);$i++){
      if (!isset($result[$role[$i]['s_id']])) $result[$role[$i]['s_id']]=$role[$i];
      $result[$role[$i]['s_id'] ]['character'][] = $role[$i];
    }

    return $result;
  }

/*  public function get_season_list($id){
    $query = $this->my_queries->query('get_season_list', ['id' => $id]);
    return $query->result();
  }

  public function get_episode_list($id,$saison){
    $query = $this->my_queries->query('get_episode_list', ['id' => $id, 'saison' => $saison]);
    return $query->result();
  }

  public function get_crew_list($id){
    $query = $this->my_queries->query('get_crew_list', ['id' => $id]);
    return $query->result();
  }
*/
}
