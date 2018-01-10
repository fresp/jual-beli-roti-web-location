<?php
session_start();
error_reporting(0);
if($_SESSION['login'] ==""){
	$_SESSION['alert'] = 'accdenied';
	header('Location:../index.php');
}
include 'template/head.php';
?>

<script type="text/javascript">

	$(document).ready(function() {
		var dataTable = $('#listwithdrawal-grid').DataTable( {
			"processing": true,
			"serverSide": true,
			"ajax":{
				url :"../data/listwithdrawal.php", 
				type: "post", 
				error: function(){  
					$(".listwithdrawal-grid-error").html("");
					$("#listwithdrawal-grid").append('<tbody class="listwithdrawal-grid-error"><tr><th colspan="5">Data kosong</th></tr></tbody>');
					$("#listwithdrawal-grid_processing").css("display","none");		
				}
			},
			"language": {
				"url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
				"sEmptyTable": "Tidak ada data di database"
			}
		} );
	} );

</script>

<div style="margin-top: 50px;padding: 10px;border-bottom: 3px solid #eee;" class="container container-top" id="listtrx">
	<form id="frm-wtrwl" action="../helper/saldo.php?aksi=savewithdrawal" method="POST" style="overflow: hidden;height: auto;background: #fff;padding: 10px;">
		<div class="column-12" style="padding: 0px;margin-top: 10px">
			<div class="column-5" style="padding: 0px;">
				<h2 style="margin: 0px">Tarik Saldo</h2>

			</div>
			<div class="column-1" style="padding: 0px;text-align: center;">
				<span></span>
			</div>
			<div class="column-6" style="padding: 0px;margin-top: -3px;float: right;text-align: right;">
				<h5 style="margin: 0px;">Saldo Kamu</h5>
				<h5 style="margin: 0px;"">Rp.<?php 
					require_once '../module/saldo.php';
					$saldo = new saldo();
					$saldodata = $saldo->data(); 
					echo $saldodata;
					?></h5>
				</div>
			</div>
			<hr style="margin-top: 15px;">
			<div style=" text-align: left; padding: 0px 5px;">

				<div>
					<div class="row" style="margin-bottom: 10px;">
						<div class="column-12">
							<div class="column-5" style="padding: 0px;">
								<label>Bank :</label>
								<select id="optbank" name="optbank" class="kb-input">
									<option value="002-BANK BRI">BANK BRI</option>
									<option value="003-BANK EKSPOR INDONESIA">BANK EKSPOR INDONESIA</option>
									<option value="008-BANK MANDIRI">BANK MANDIRI</option>
									<option value="009-BANK BNI">BANK BNI</option>
									<option value="011-BANK DANAMON">BANK DANAMON</option>
									<option value="013-PERMATA BANK">PERMATA BANK</option>
									<option value="014-BANK BCA">BANK BCA</option>
									<option value="016-BANK BII">BANK BII</option>
									<option value="019-BANK PANIN">BANK PANIN</option>
									<option value="020-BANK ARTA NIAGA KENCANA ">BANK ARTA NIAGA KENCANA </option>
									<option value="022-BANK NIAGA">BANK NIAGA</option>
									<option value="023-BANK BUANA IND ">BANK BUANA IND </option>
									<option value="026-BANK LIPPO">BANK LIPPO</option>
									<option value="028-BANK NISP">BANK NISP</option>
									<option value="030-AMERICAN EXPRESS BANK LTD ">AMERICAN EXPRESS BANK LTD </option>
									<option value="031-CITIBANK N.A.">CITIBANK N.A.</option>
									<option value="032-JP. MORGAN CHASE BANK, N.A. ">JP. MORGAN CHASE BANK, N.A. </option>
									<option value="033-BANK OF AMERICA, N.A ">BANK OF AMERICA, N.A </option>
									<option value="034-ING INDONESIA BANK">ING INDONESIA BANK</option>
									<option value="036-BANK MULTICOR TBK. ">BANK MULTICOR TBK. </option>
									<option value="037-BANK ARTHA GRAHA">BANK ARTHA GRAHA</option>
									<option value="039-BANK CREDIT AGRICOLE INDOSUEZ ">BANK CREDIT AGRICOLE INDOSUEZ </option>
									<option value="040-THE BANGKOK BANK COMP. LTD ">THE BANGKOK BANK COMP. LTD </option>
									<option value="041-THE HONGKONG & SHANGHAI B.C. ">THE HONGKONG & SHANGHAI B.C. </option>
									<option value="042-THE BANK OF TOKYO MITSUBISHI UFJ LTD ">THE BANK OF TOKYO MITSUBISHI UFJ LTD </option>
									<option value="045-BANK SUMITOMO MITSUI INDONESIA ">BANK SUMITOMO MITSUI INDONESIA </option>
									<option value="046-BANK DBS INDONESIA ">BANK DBS INDONESIA </option>
									<option value="047-BANK RESONA PERDANIA ">BANK RESONA PERDANIA </option>
									<option value="048-BANK MIZUHO INDONESIA ">BANK MIZUHO INDONESIA </option>
									<option value="050-STANDARD CHARTERED BANK ">STANDARD CHARTERED BANK </option>
									<option value="052-BANK ABN AMRO ">BANK ABN AMRO </option>
									<option value="053-BANK KEPPEL TATLEE BUANA ">BANK KEPPEL TATLEE BUANA </option>
									<option value="054-BANK CAPITAL INDONESIA, TBK. ">BANK CAPITAL INDONESIA, TBK. </option>
									<option value="057-BANK BNP PARIBAS INDONESIA ">BANK BNP PARIBAS INDONESIA </option>
									<option value="058-BANK UOB INDONESIA ">BANK UOB INDONESIA </option>
									<option value="059-KOREA EXCHANGE BANK DANAMON ">KOREA EXCHANGE BANK DANAMON </option>
									<option value="060-RABOBANK INTERNASIONAL INDONESIA ">RABOBANK INTERNASIONAL INDONESIA </option>
									<option value="061-ANZ PANIN BANK ">ANZ PANIN BANK </option>
									<option value="067-DEUTSCHE BANK AG. ">DEUTSCHE BANK AG. </option>
									<option value="068-BANK WOORI INDONESIA ">BANK WOORI INDONESIA </option>
									<option value="069-BANK OF CHINA LIMITED ">BANK OF CHINA LIMITED </option>
									<option value="076-BANK BUMI ARTA ">BANK BUMI ARTA </option>
									<option value="087-BANK EKONOMI ">BANK EKONOMI </option>
									<option value="088-BANK ANTARDAERAH ">BANK ANTARDAERAH </option>
									<option value="089-BANK HAGA ">BANK HAGA </option>
									<option value="093-BANK IFI ">BANK IFI </option>
									<option value="095-BANK CENTURY, TBK. ">BANK CENTURY, TBK. </option>
									<option value="097-BANK MAYAPADA ">BANK MAYAPADA </option>
									<option value="110-BANK JABAR ">BANK JABAR </option>
									<option value="111-BANK DKI ">BANK DKI </option>
									<option value="112-BPD DIY ">BPD DIY </option>
									<option value="113-BANK JATENG ">BANK JATENG </option>
									<option value="114-BANK JATIM ">BANK JATIM </option>
									<option value="115-BPD JAMBI ">BPD JAMBI </option>
									<option value="116-BPD ACEH ">BPD ACEH </option>
									<option value="117-BANK SUMUT ">BANK SUMUT </option>
									<option value="118-BANK NAGARI ">BANK NAGARI </option>
									<option value="119-BANK RIAU ">BANK RIAU </option>
									<option value="120-BANK SUMSEL ">BANK SUMSEL </option>
									<option value="121-BANK LAMPUNG ">BANK LAMPUNG </option>
									<option value="122-BPD KALSEL ">BPD KALSEL </option>
									<option value="123-BPD KALIMANTAN BARAT ">BPD KALIMANTAN BARAT </option>
									<option value="124-BPD KALTIM ">BPD KALTIM </option>
									<option value="125-BPD KALTENG ">BPD KALTENG </option>
									<option value="126-BPD SULSEL ">BPD SULSEL </option>
									<option value="127-BANK SULUT ">BANK SULUT </option>
									<option value="128-BPD NTB ">BPD NTB </option>
									<option value="129-BPD BALI ">BPD BALI </option>
									<option value="130-BANK NTT ">BANK NTT </option>
									<option value="131-BANK MALUKU ">BANK MALUKU </option>
									<option value="132-BPD PAPUA ">BPD PAPUA </option>
									<option value="133-BANK BENGKULU ">BANK BENGKULU </option>
									<option value="134-BPD SULAWESI TENGAH ">BPD SULAWESI TENGAH </option>
									<option value="135-BANK SULTRA ">BANK SULTRA </option>
									<option value="145-BANK NUSANTARA PARAHYANGAN ">BANK NUSANTARA PARAHYANGAN </option>
									<option value="146-BANK SWADESI ">BANK SWADESI </option>
									<option value="147-BANK MUAMALAT ">BANK MUAMALAT </option>
									<option value="151-BANK MESTIKA">BANK MESTIKA</option>
									<option value="152-BANK METRO EXPRESS ">BANK METRO EXPRESS </option>
									<option value="153-BANK SHINTA INDONESIA ">BANK SHINTA INDONESIA </option>
									<option value="157-BANK MASPION ">BANK MASPION </option>
									<option value="159-BANK HAGAKITA ">BANK HAGAKITA </option>
									<option value="161-BANK GANESHA ">BANK GANESHA </option>
									<option value="162-BANK WINDU KENTJANA ">BANK WINDU KENTJANA </option>
									<option value="164-HALIM INDONESIA BANK ">HALIM INDONESIA BANK </option>
									<option value="166-BANK HARMONI INTERNATIONAL ">BANK HARMONI INTERNATIONAL </option>
									<option value="167-BANK KESAWAN ">BANK KESAWAN </option>
									<option value="200-BANK TABUNGAN NEGARA (PERSERO)">BANK TABUNGAN NEGARA (PERSERO)</option>
									<option value="212-BANK HIMPUNAN SAUDARA 1906, TBK ">BANK HIMPUNAN SAUDARA 1906, TBK </option>
									<option value="213-BANK TABUNGAN PENSIUNAN NASIONAL ">BANK TABUNGAN PENSIUNAN NASIONAL </option>
									<option value="405-BANK SWAGUNA ">BANK SWAGUNA </option>
									<option value="422-BANK JASA ARTA ">BANK JASA ARTA </option>
									<option value="426-BANK MEGA ">BANK MEGA </option>
									<option value="427-BANK JASA JAKARTA ">BANK JASA JAKARTA </option>
									<option value="441-BANK BUKOPIN">BANK BUKOPIN</option>
									<option value="451-BANK SYARIAH MANDIRI ">BANK SYARIAH MANDIRI </option>
									<option value="459-BANK BISNIS INTERNASIONAL ">BANK BISNIS INTERNASIONAL </option>
									<option value="466-BANK SRI PARTHA ">BANK SRI PARTHA </option>
									<option value="472-BANK JASA JAKARTA ">BANK JASA JAKARTA </option>
									<option value="484-BANK BINTANG MANUNGGAL ">BANK BINTANG MANUNGGAL </option>
									<option value="485-BANK BUMIPUTERA ">BANK BUMIPUTERA </option>
									<option value="490-BANK YUDHA BHAKTI ">BANK YUDHA BHAKTI </option>
									<option value="491-BANK MITRANIAGA ">BANK MITRANIAGA </option>
									<option value="494-BANK AGRO NIAGA ">BANK AGRO NIAGA </option>
									<option value="498-BANK INDOMONEX ">BANK INDOMONEX </option>
									<option value="501-BANK ROYAL INDONESIA ">BANK ROYAL INDONESIA </option>
									<option value="503-BANK ALFINDO ">BANK ALFINDO </option>
									<option value="506-BANK SYARIAH MEGA ">BANK SYARIAH MEGA </option>
									<option value="513-BANK INA PERDANA ">BANK INA PERDANA </option>
									<option value="517-BANK HARFA ">BANK HARFA </option>
									<option value="520-PRIMA MASTER BANK ">PRIMA MASTER BANK </option>
									<option value="521-BANK PERSYARIKATAN INDONESIA ">BANK PERSYARIKATAN INDONESIA </option>
									<option value="525-BANK AKITA ">BANK AKITA </option>
									<option value="526-LIMAN INTERNATIONAL BANK ">LIMAN INTERNATIONAL BANK </option>
									<option value="531-ANGLOMAS INTERNASIONAL BANK ">ANGLOMAS INTERNASIONAL BANK </option>
									<option value="523-BANK DIPO INTERNATIONAL ">BANK DIPO INTERNATIONAL </option>
									<option value="535-BANK KESEJAHTERAAN EKONOMI ">BANK KESEJAHTERAAN EKONOMI </option>
									<option value="536-BANK UIB ">BANK UIB </option>
									<option value="542-BANK ARTOS IND ">BANK ARTOS IND </option>
									<option value="547-BANK PURBA DANARTA ">BANK PURBA DANARTA </option>
									<option value="548-BANK MULTI ARTA SENTOSA ">BANK MULTI ARTA SENTOSA </option>
									<option value="553-BANK MAYORA ">BANK MAYORA </option>
									<option value="555-BANK INDEX SELINDO ">BANK INDEX SELINDO </option>
									<option value="566-BANK VICTORIA INTERNATIONAL ">BANK VICTORIA INTERNATIONAL </option>
									<option value="558-BANK EKSEKUTIF ">BANK EKSEKUTIF </option>
									<option value="559-CENTRATAMA NASIONAL BANK ">CENTRATAMA NASIONAL BANK </option>
									<option value="562-BANK FAMA INTERNASIONAL ">BANK FAMA INTERNASIONAL </option>
									<option value="564-BANK SINAR HARAPAN BALI ">BANK SINAR HARAPAN BALI </option>
									<option value="567-BANK HARDA ">BANK HARDA </option>
									<option value="945-BANK FINCONESIA ">BANK FINCONESIA </option>
									<option value="946-BANK MERINCORP ">BANK MERINCORP </option>
									<option value="947-BANK MAYBANK INDOCORP ">BANK MAYBANK INDOCORP </option>
									<option value="948-BANK OCBC – INDONESIA ">BANK OCBC – INDONESIA </option>
									<option value="949-BANK CHINA TRUST INDONESIA ">BANK CHINA TRUST INDONESIA </option>
									<option value="950-BANK COMMONWEALTH ">BANK COMMONWEALTH </option>
								</select>
							</div>
							
							<div class="column-2" style="padding: 0px;text-align: center;">
								<span></span>
							</div>
							<div class="column-5" style="padding: 0px;">
								<label >Atas Nama :</label>
								<input class="kb-input alpha" type="text" name="atsnama" id="atsnama" placeholder="Atas Nama">
							</div>
						</div>
					</div>
					<div class="row" style="margin-bottom: 10px;">
						<div class="column-12">
							<div class="column-5" style="padding: 0px;">
								<label >Jumlah Saldo :</label>
								<input class="kb-input" type="text" name="jmlhsaldo" id="jmlhsaldo" placeholder="Jumlah Saldo">
							</div>
							<div class="column-2" style="padding: 0px;text-align: center;margin-top: 10px;">
								<span></span>
							</div>
							<div class="column-5" style="padding: 0px;">
								<label>No Rekening :</label>
								<input class="kb-input" type="text" name="norek" id="norek" placeholder="Nomer Rekening">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="column-12" style="margin-bottom: 10px;margin-top: 20px;">
							<input name="submit" class="kb-button  button-float kb-button2" style="width: 100%;cursor: pointer;" value="Simpan" type="submit">
						</div>
					</div>
					CATATAN :
					<br>+Minimal Penarikan 20rb 
					<br>+Selain Bank BCA akan dikenanakan Biaya Transfer Bank Sebesar 6500
					
				</div>
			</div>
		</form>

		<div class="search-content" style="background: #fff;padding: 0px 10px;" >
			<h3 style="padding-top: 10px">Riwayat Tarik Tunai</h3>
			<hr>
			<div style="width: 100%;overflow: auto;">
				<table id="listwithdrawal-grid"  cellpadding="0" cellspacing="0" border="0" class="display" width="100%" >
					<thead>
						<tr>
							<th>Tanggal</th>
							<th>Status</th>
							<th>Nama Bank</th>
							<th>Nama Pemilik Bank</th>
							<th>Nomer Rekening</th>
							<th>Jumlah Penarikan</th>
							
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
	<?php
	include 'template/footer2.php';
	?>
