<?php class Grafik extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
		
		$this->load->model('Muser');
		$this->load->helper(array('form','url'));
		$this->load->model('Mlaporan');
		$this->load->model('Mgrafik');
	}
	function grafik_pendapatan(){
		$this->auth->restrict();
		$this->auth->cek_menu(1);

			$id_level = $this->session->userdata('id_level');
			$data['menu'] = $this->Muser->get_menu_for_level($id_level);

		$this->load->library('FusionCharts');

		if($this->uri->segment(6) == '')
			$chartType = 'Line';
		else
			$chartType =$this->uri->segment(6);
		 
		$width = '850';
		$height = '420';
		 
		$chart = new FusionCharts($chartType, $width, $height);
		 
		$caption = '';
		$xAxisName = 'Bulan';
		$yAxisName = 'Jumlah (Pendapatan)';
		$decimalPrecision = '0';
		$formatNumberScale = '0';
		$showNames = '1';
		
		$strXML = "
		<graph caption='".$caption."' 
		xAxisName='".$xAxisName."'
		yAxisName='".$yAxisName."' 
		decimalPrecision='".$decimalPrecision."' 
		formatNumberScale='".$formatNumberScale."'>
		";
		$query=$this->Mgrafik->grafik_pendapatan();
		foreach($query as $row){
		$strXML .= "
		<set name='Jan' value='".$row->Jan."' color='245ED0' />
		<set name='Feb' value='".$row->Feb."' color='245ED0' />
		<set name='Mar' value='".$row->Mar."' color='245ED0' />
		<set name='Apr' value='".$row->Apr."' color='245ED0' />
		<set name='Mei' value='".$row->Mei."' color='245ED0' />
		<set name='Jun' value='".$row->Jun."' color='245ED0' />
		<set name='Jul' value='".$row->Jul."' color='245ED0' />
		<set name='Agst' value='".$row->Agst."' color='245ED0' />
		<set name='Sept' value='".$row->Sept."' color='245ED0' />
		<set name='Okt' value='".$row->Okt."' color='245ED0' />
		<set name='Nov' value='".$row->Nov."' color='245ED0' />
		<set name='Des' value='".$row->Des."' color='245ED0' />
		";
		}
		$strXML .="</graph>";
		
		$data['chart'] = $chart->renderChartHTML(base_url().'Charts/FCF_'.$chartType.'.swf', '', $strXML, 'chartId', $width, $height);

		$data['tahun']=$this->Mgrafik->grafik_pendapatan();
		$data['content']= 'laporan/grafik_pendapatan';
		$this->load->view('admin/template', $data);
	}
	function grafik_penjualan(){
		$this->auth->restrict();
		$this->auth->cek_menu(1);

			$id_level = $this->session->userdata('id_level');
			$data['menu'] = $this->Muser->get_menu_for_level($id_level);

		$this->load->library('FusionCharts');

		if($this->uri->segment(6) == '')
			$chartType = 'Line';
		else
			$chartType =$this->uri->segment(6);
		 
		$width = '850';
		$height = '420';
		 
		$chart = new FusionCharts($chartType, $width, $height);
		 
		$caption = '';
		$xAxisName = 'Bulan';
		$yAxisName = 'Jumlah (Pendapatan)';
		$decimalPrecision = '0';
		$formatNumberScale = '0';
		$showNames = '1';
		
		$strXML = "
		<graph caption='".$caption."' 
		xAxisName='".$xAxisName."'
		yAxisName='".$yAxisName."' 
		decimalPrecision='".$decimalPrecision."' 
		formatNumberScale='".$formatNumberScale."'>
		";
		$query=$this->Mgrafik->grafik_penjualan();
		foreach($query as $row){
		$strXML .= "
		<set name='Jan' value='".$row->Jan."' color='245ED0' />
		<set name='Feb' value='".$row->Feb."' color='245ED0' />
		<set name='Mar' value='".$row->Mar."' color='245ED0' />
		<set name='Apr' value='".$row->Apr."' color='245ED0' />
		<set name='Mei' value='".$row->Mei."' color='245ED0' />
		<set name='Jun' value='".$row->Jun."' color='245ED0' />
		<set name='Jul' value='".$row->Jul."' color='245ED0' />
		<set name='Agst' value='".$row->Agst."' color='245ED0' />
		<set name='Sept' value='".$row->Sept."' color='245ED0' />
		<set name='Okt' value='".$row->Okt."' color='245ED0' />
		<set name='Nov' value='".$row->Nov."' color='245ED0' />
		<set name='Des' value='".$row->Des."' color='245ED0' />
		";
		}
		$strXML .="</graph>";
		
		$data['chart'] = $chart->renderChartHTML(base_url().'Charts/FCF_'.$chartType.'.swf', '', $strXML, 'chartId', $width, $height);

		$data['tahun']=$this->Mgrafik->grafik_penjualan();
		$data['content']= 'laporan/grafik_penjualan';
		$this->load->view('admin/template', $data);
	}
}
?>