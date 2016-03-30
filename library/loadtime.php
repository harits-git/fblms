<?
  //class php load time
  class LoadTime {

    private $waktu_awal;
    private $waktu_akhir;
    private $selisih;

    public function startLoad(){
        $this->waktu_awal = microtime();
    }

    public function endLoad(){
        $this->selisih = microtime()-$this->waktu_awal;
        return '<i>load time '.number_format($this->selisih,5).' microsecond</i>';
    }

  }

?>