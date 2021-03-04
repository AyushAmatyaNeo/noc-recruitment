
<main class="main-vacancies bg-light">
	<section class="applied-vacancies-sec">
		<div class="container-fluid">
				<h5 class="main-title">Applied Vacancies</h5>
				<table class="table table-striped table-bordered table-sm table-responsive-lg tbl-applied-vacancies">
					<thead style="font-size: 13px; color: #fff; background-color: #47759E; text-align: center;">
		                <tr>
						   <th scope="col" rowspan="2" style="width: 5%">Application Number</th>
						   <th scope="col" rowspan="2">Ad. No.</th>
						   <th scope="col" rowspan="2">Post</th>
						   <th scope="col" rowspan="2" style="width: 10%">Admit Card Download</th>
						   <th colspan="3">Pay</th>
						   <th scope="col" rowspan="2">Print Slip</th>
						   <th scope="col" rowspan="2">Voucher</th>
						   <th colspan="2">Verification</th>
						   <th scope="col" rowspan="2" style="width: 7%">Exam Roll No.</th>
						   <th scope="col" rowspan="2">Note</th>
						</tr>
						<tr>
						   <th>FonePay</th>
						   <th>Esewa</th>
						   <th>connectIPS</th>
						   <th>Form</th>
						   <th>Payment</th>
						</tr>
               		</thead>
               		<tbody style="font-size: 13px;">
						<tr>
							<td>1</td>
							<td>11/2077-78</td>
							<td>Senior Section Chief/9</td>
							<td><a class="btn btn-primary btn-apply" href="" role="button">Download</a></td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>4</td>
							<td>5</td>
							<td>6</td>
							<td>7</td>
							<td>8</td>
							<td>9</td>
						</tr>
						<tr>
							<td>1</td>
							<td>11/2077-78</td>
							<td>Senior Section Chief/9</td>
							<td><a class="btn btn-primary btn-apply" href="" role="button">Download</a></td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>4</td>
							<td>5</td>
							<td>6</td>
							<td>7</td>
							<td>8</td>
							<td>9</td>
						</tr>
						<tr>
							<td>1</td>
							<td>11/2077-78</td>
							<td>Senior Section Chief/9</td>
							<td><a class="btn btn-primary btn-apply" href="" role="button">Download</a></td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>4</td>
							<td>5</td>
							<td>6</td>
							<td>7</td>
							<td>8</td>
							<td>9</td>
						</tr>
						<tr>
							<td>1</td>
							<td>11/2077-78</td>
							<td>Senior Section Chief/9</td>
							<td><a class="btn btn-primary btn-apply" href="" role="button">Download</a></td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>4</td>
							<td>5</td>
							<td>6</td>
							<td>7</td>
							<td>8</td>
							<td>9</td>
						</tr>
					</tbody>
				</table>
		</div>
	</section>
	<section class="vacancies-sec">
		<div class="container-fluid">
				<h5 class="main-title">Active Vacancies</h5>
				<table class="table table-striped table-bordered table-sm table-responsive-md tbl-vacancies">
					<thead style="font-size: 13px; color: #fff; background-color: #f90501; text-align: center;">
						<tr>
							<th scope="col" style="width: 5%">S.No.</th>
							<th scope="col" style="width: 10%">Ad Number</th>
							<th scope="col" style="width: 10%">Designation</th>
							<th scope="col" style="width: 10%">Department</th>
							<th scope="col" style="width: 25%">Description</th>
							<th scope="col" style="width: 10%">File</th>
							<th scope="col" style="width: 10%">Apply</th>
						</tr>
					</thead>
					<tbody style="font-size: 13px;">
					<?php  
						$counter = 0;
						foreach ($vacancylists as $vacancylist)  
							{ 	
								$counter = $counter+1; ?>					
						<tr>
							<td><?php echo $counter ?></td>
							<td><?php echo $vacancylist['AD_NO'];?></td>
							<td><?php echo $vacancylist['DESIGNATION_TITLE'];?></td>
							<td><?php echo $vacancylist['DEPARTMENT_NAME'];?></td>
							<!-- <td><?php //echo $row['OPEN_INTERNAL'] ?></td> -->
							<?php   $vacancylist['FILE_NAME'] = 'Vacancy_file';
									$vacancylist['FILE_IN_DIR_NAME'] = '1611204085.pdf';  
							?>
							<td><?php echo $vacancylist['VACANCY_EDESC']; ?></td>
							<td><?php if($vacancylist['FILE_NAME']) { ?><a target="_blank" href="<?php echo base_url().'../../neo-hris/public/uploads/noc_documents/'.$vacancylist['FILE_IN_DIR_NAME']; ?>" >
							<i class="fa fa-file"></i>&nbsp;<?php echo $vacancylist['FILE_NAME']; ?></a><?php  } ?></td>
							<td><a class="btn btn-primary btn-apply" href="<?php echo base_url('vacancy/apply/').$vacancylist['VACANCY_ID'] ?>" role="button">Apply</a></td>
						</tr>
						
						<?php  } ?>
					</tbody>
				</table>
		</div>
	</section>
</main>