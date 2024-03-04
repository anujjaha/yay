<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model('Cybera_model');

		$data['options'] = $this->Cybera_model->getAllOptions();

		$this->template->load('public', 'public', $data);
	}

	public function confirmQty()
	{
		$this->load->model('Cybera_model');
		$input = $this->input->post();
		$categoryId = $input['categoryId'];
		$dealerCategoryType = 0;
		$pside = $input['pside'];
		$qty = $input['qty'];
		$cost = 0;
		$dealerRec = [];
		
		if(isset($input['dealerId']) && !empty($input['dealerId']))
		{
			$dealerRec = $this->Cybera_model->getDealerById($input['dealerId']);
			if($dealerRec)
			{
				$dealerCategoryType = 1;
			}
		}
		
		$allItemList = $this->Cybera_model->getProcessListById($dealerCategoryType, $categoryId);

		foreach($allItemList as $item)
		{
			if(strpos($item['qty_range'], '-'))
			{
				$breakRange = explode('-', $item['qty_range']);
				$startRange = $breakRange[0];
				$endRange   = $breakRange[1];

				if($qty >= $startRange && $qty <= $endRange)
				{
					$cost = $item['approx_cost'];
					break;
				}
			}
			else
			{
				$cost = $item['approx_cost'] / $item['qty_range'];
				
				if($qty > $item['qty_range'])
				{
					continue;
				} else {
					$cost = $item['approx_cost'] / $item['qty_range'];
					break;
				}	
			}
			
		}

		echo json_encode([
			'status' => true,
			'perItem' => $cost,
			'qty' => $qty,
			'cost'=> $qty * $cost,
			'isDealer' => $dealerCategoryType,
			'dealerRec' => $dealerRec
		]);

		die;

	}

	public function confirmQtyFB()
	{
		$this->load->model('Cybera_model');
		$input = $this->input->post();
		$categoryId = $input['categoryId'];
		$dealerCategoryType = 0;
		$pside = $input['pside'];
		$qty = $input['qty'];
		$cost = 0;
		$dealerRec = [];
		
		if(isset($input['dealerId']) && !empty($input['dealerId']))
		{
			$dealerRec = $this->Cybera_model->getDealerById($input['dealerId']);
			if($dealerRec)
			{
				$dealerCategoryType = 1;
			}
		}
		
		$allItemList = $this->Cybera_model->getProcessListById($dealerCategoryType, $categoryId);

		foreach($allItemList as $singleItem)
		{
			$isFound = $this->checkBetween($qty, $singleItem['qty_range']);

			if($isFound)
			{
				if($qty < 11)
				{
					$cost = $singleItem['approx_cost'];
				}
				else
				{
					$cost = $singleItem['approx_cost'];
				}
			}

			$totalCost = $cost * $qty;
			if($qty < 11)
			{
				$totalCost = $cost;
			}
		}

		echo json_encode([
			'status' => true,
			'perItem' => $cost,
			'qty' => $qty,
			'cost'=> $qty * $cost,
			'isDealer' => $dealerCategoryType,
			'dealerRec' => $dealerRec
		]);

		die;

	}

	public function checkBetween($qty, $range)
	{
		$split = explode('-', $range);
		$lower=$split[0];
		$upper=$split[1];

		if($lower <= $qty && $qty <= $upper)
		{
			return true;
		}

		return false;
	}

	public function generatePDF($value='')
	{
		$input = $this->input->post();
		$pdfHtml = '<table border="1" cellpadding="1">';

		if(isset($input['estimateDealerName']) && isset($input['estimateDealerMobile']) && !empty($input['estimateDealerName']))
		{
		
			$pdfHtml .= '<tr>
				<td colspan="4">Name: '. $input['estimateDealerName'] .'</td>
				<td align="right" colspan="4">Mobile: '. $input['estimateDealerMobile'] . '</td>
			</tr>';
		}
		
		$pdfHtml .= '<tr>
			<td>Product Title</td>
			<td>Print Side</td>
			<td>Qty</td>
			<td>Rate</td>
			<td>Sub Total</td>
			<td>GST (%)</td>
			<td>GST Total</td>
			<td>Total</td>
		</tr>';

		
		$grandTotal = 0;
		$subTotal = 0;
		$gstTotal = 0;
		for($i = 1; $i <= count($input['categoryValue']); $i++)
		{
		$pdfHtml .= '<tr>
				<td>'. $input['categoryValue'][$i] . '</td>
				<td align="center">'. $input['printSide'][$i] . '</td>
				<td>'. $input['qty'][$i] . '</td>
				<td align="right">'. $input['perItemCostInput'][$i] . '</td>
				<td align="right">'. $input['perItemTotalCostInput'][$i] . '</td>
				<td align="center">'. $input['gst'][$i] . '</td>
				<td align="right">'. $input['totalGSTInput'][$i] . '</td>
				<td align="right">'. $input['totalCostWithGstInput'][$i] . '</td>
			</tr>';

			$grandTotal = $grandTotal + $input['totalCostWithGstInput'][$i];
			$subTotal 	= $subTotal + $input['perItemTotalCostInput'][$i];
			$gstTotal 	= $gstTotal + $input['totalGSTInput'][$i];
		}

	$pdfHtml .= '<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td align="right">'. $subTotal . '</td>
			<td>&nbsp;</td>
			<td align="right">' . $gstTotal . '</td>
			<td align="right">'. $grandTotal .'</td>
		</tr>
	</table>';

		require_once(APPPATH . '/libraries/tcpdf/tcpdf.php');
			// Create new PDF document
		$pdf = new TCPDF();

		// Add a page
		$pdf->AddPage();

		// Write HTML content
		$pdf->writeHTML($pdfHtml);

		// Output PDF
		$filePath  = FCPATH . 'assets/pdf/';
		$fileName  = 'cybera-estimation'.time().'.pdf';
		
		$pdf->Output($filePath .  $fileName, 'F');
		echo json_encode([
			'file' => $fileName
		]);
		exit;
	}

	/**
	 * Send Email
	 */
	public function sendEmail()
	{
		$input = $this->input->post();
		$this->load->model('Cybera_model');
		$to = null;

		if(isset($input['publicEmailId']) && !empty($input['publicEmailId']))
		{
			$to = $input['publicEmailId'];
		}

		if($to == null && isset($input['estimateDealerId']) && !empty($input['estimateDealerId']))
		{
			$dealerRec = $this->Cybera_model->getDealerByUserId($input['estimateDealerId']);
			if(isset($dealerRec))
			{
				$to = $dealerRec->emailid;
			}
		}

		$pdfHtml = '<table border="1" cellpadding="1">';

		if(isset($input['estimateDealerName']) && isset($input['estimateDealerMobile']) && !empty($input['estimateDealerName']))
		{
		
			$pdfHtml .= '<tr>
				<td colspan="4">Name: '. $input['estimateDealerName'] .'</td>
				<td align="right" colspan="4">Mobile: '. $input['estimateDealerMobile'] . '</td>
			</tr>';
		}
		
		$pdfHtml .= '<tr>
			<td>Product Title</td>
			<td>Print Side</td>
			<td>Qty</td>
			<td>Rate</td>
			<td>Sub Total</td>
			<td>GST (%)</td>
			<td>GST Total</td>
			<td>Total</td>
		</tr>';

		
		$grandTotal = 0;
		$subTotal = 0;
		$gstTotal = 0;
		for($i = 1; $i <= count($input['categoryValue']); $i++)
		{
		$pdfHtml .= '<tr>
				<td>'. $input['categoryValue'][$i] . '</td>
				<td align="center">'. $input['printSide'][$i] . '</td>
				<td>'. $input['qty'][$i] . '</td>
				<td align="right">'. $input['perItemCostInput'][$i] . '</td>
				<td align="right">'. $input['perItemTotalCostInput'][$i] . '</td>
				<td align="center">'. $input['gst'][$i] . '</td>
				<td align="right">'. $input['totalGSTInput'][$i] . '</td>
				<td align="right">'. $input['totalCostWithGstInput'][$i] . '</td>
			</tr>';

			$grandTotal = $grandTotal + $input['totalCostWithGstInput'][$i];
			$subTotal 	= $subTotal + $input['perItemTotalCostInput'][$i];
			$gstTotal 	= $gstTotal + $input['totalGSTInput'][$i];
		}

		$pdfHtml .= '<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td align="right">'. $subTotal . '</td>
				<td>&nbsp;</td>
				<td align="right">' . $gstTotal . '</td>
				<td align="right">'. $grandTotal .'</td>
			</tr>
		</table>
		<div>
		<p>Online estimation valid till 9 PM Today ('.date('d-m-Y.').').</p>
		</div>
		';

		require_once(APPPATH . '/libraries/mailer/src/PHPMailer.php');
		require_once(APPPATH . '/libraries/mailer/src/SMTP.php');
		
		$mail = new PHPMailer\PHPMailer\PHPMailer();
		$mail->IsSMTP(); // enable SMTP
		
		$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
	    $mail->SMTPAuth = true; // authentication enabled
	    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
	    $mail->Host = "smtpout.secureserver.net";
	    $mail->Port = 465; // or 587
	    $mail->IsHTML(true);
	    $mail->Username = "info@adroitclick.com";
	    $mail->Password = "Adt@12345678";
	    $mail->SetFrom("info@adroitclick.com");
	    $mail->Subject = 'Online Estimation - ' . date('Y-m-d h:i a');
	    $mail->Body = $pdfHtml;
	    $mail->AddAddress($to);
	    $mail->addReplyTo('er.anujjaha@gmail.com');
    	$mail->addCC('er.anujjaha@gmail.com');
    	// $mail->addBCC($input['bcc']);

	    if($mail->Send()) {
	    	echo json_encode([
			'status' => 1
		]);
		exit;
		}

		echo json_encode([
			'status' => 0
		]);
		exit;
	}
}
