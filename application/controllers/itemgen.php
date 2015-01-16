<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ItemGen extends CI_Controller {
	public function __construct(){
		parent::__construct();
		include_once './vendor/autoload.php';
		$this->load->library('session');
		$this->load->helper(array('form', 'url'));
	}

	public function generate(){
		if(!$this->session->userdata('logged_in')){
			echo "You are not logged in";
		}else{
			$origfilename = $_FILES['pdf_file']['name'];
			$uname = $this->session->userdata('username');
			for($i=0;$i<count($_FILES['pdf_file']['name']);$i++){
				$newfilename[$i]=$uname."_".$origfilename[$i];
			}
			$this->load->library('upload');

			$config['file_name'] = $newfilename;
			$config['upload_path'] = './pdf/';
			$config['allowed_types'] = 'pdf';
			$config['max_size']	= '0';
			$config['overwrite'] = TRUE;

			$this->upload->initialize($config);

			if (!$this->upload->do_multi_upload('pdf_file')){
				echo  $this->upload->display_errors();
			}
			else{
				$parser = new Smalot\PdfParser\Parser();
				$pos = new \StanfordNLP\POSTagger(
					'./stanford-postagger-2014-10-26/models/english-left3words-distsim.tagger',
					'./stanford-postagger-2014-10-26/stanford-postagger.jar'
				);

				$tokenizer = new \NlpTools\Tokenizers\WhitespaceAndPunctuationTokenizer();

				$slide = array_fill(0, count($newfilename), 0);
				$tagged = array_fill(0, count($newfilename), 0);
				for($i=0;$i<count($newfilename);$i++){
					$pdf = $parser->parseFile("./pdf/{$newfilename[$i]}");
					$pages = $pdf->getPages();

					foreach ($pages as $page){
						$slide[$i] = $slide[$i]." ".utf8_decode($page->getText());
					}

					$sentence = preg_split('/\.|\?|!/', $slide[$i]);

					if(strlen($sentence[count($sentence)-1])==0){
						array_pop($sentence);
					}

					foreach ($sentence as $k => $v) {
						$sentence[$k] = $tokenizer->tokenize($v);
					}

					$tagged[$i] = $pos->batchTag($sentence);
				}

				for($i = 0; $i < count($newfilename);$i++){
					unlink("./pdf/{$newfilename[$i]}");
				}

				var_dump($tagged[0][0]);

				/*$a = new PDF2Text();
				$a->setFilename("./pdf/{$newfilename[0]}");
				$a->decodePDF();
				echo $a->output();*/
			}
		}
	}
}