<main class="main-vacancies bg-light">
		<section class="applied-vacancies-sec sec-padd">
			<div class="container-fluid">
                <div style="float: right">
                <a href="<?php echo base_url('users/logout'); ?>" class="logout">Logout</a>
                </div>
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
				<h5 class="main-title">Vacancies</h5>
				<table class="table table-striped table-bordered table-sm table-responsive-md tbl-vacancies">
					<thead style="font-size: 13px; color: #fff; background-color: #f90501; text-align: center;">
						<tr>
							<th scope="col" style="width: 5%">S.No.</th>
							<th scope="col" style="width: 10%">Ad Number</th>
							<th scope="col" style="width: 16%">Designation</th>
							<th scope="col" style="width: 16%">Department</th>
							<th scope="col" style="width: 14%">Variation</th>
							<th scope="col" style="width: 27%">Description</th>
							<th scope="col" style="width: 10%">Apply</th>
						</tr>
					</thead>
					<tbody style="font-size: 13px;">
					<?php  
						$counter = 0;
						foreach ($vacancylist as $row)  
							{ 
								$counter = $counter+1;
								// var_dump($row) ; die;
					?>					
						<tr>
							<td><?php echo $counter ?></td>
							<td><?php echo $row['AD_NO'];?></td>
							<td><?php echo $row['DESIGNATION_TITLE'];?></td>
							<td><?php echo $row['DEPARTMENT_NAME'];?></td>
							<td><?php echo $row['OPEN_INTERNAL'] ?></td>
							<td><?php echo $row['VACANCY_EDESC']->load(); ?></td>
							<td><a class="btn btn-primary btn-apply" href="" role="button">Apply</a></td>
						</tr>
						
						<?php } ?>
					</tbody>
				</table>
			</div>
		</section>
	</main>