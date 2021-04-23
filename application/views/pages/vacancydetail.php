<main class="main-vacancy-detail sec-padd bg-light">
    <section class="vacancy-detail-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="vacancy-detail-inner card">
                        <div class="card-body">
                            <div class="vacancy-detail-top">
                                लोक सेवा आयोगबाट लिइने निगमको आन्तरिक तथा खुला प्रतियोगितात्मक लिखित परीक्षा कार्यक्रम र परीक्षा भवन कायम गरिएको सूचना (सूचना नम्वरः ६/२०७६-७७)
                                <div class="vacancy-date">
                                    <small><i class="fa fa-calendar" aria-hidden="true"></i> Last Date: <?php echo $details[0]['END_DATE'] ?></small>
                                    <small><i class="fa fa-calendar" aria-hidden="true"></i> Extended Date: <?php echo $details[0]['EXTENDED_DATE'] ?></small>
                                </div>
                            </div>
                            <hr>
                            <div class="vacancy-detail-content">
                                <h6 class="vacancy-subTitle">Vacancy Description</h6>
                                <p><?php echo $details[0]['VACANCY_EDESC'] ?></p>
                                <p><?php echo $details[0]['VACANCY_NDESC'] ?></p>
                                <h6 class="vacancy-subTitle">Basic Job Information</h6>
                                <table class="table table-responsive">
                                    <tr>
                                        <th>Advertisement No.</th>
                                        <td><?php echo $details[0]['AD_NO'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Opening No.</th>
                                        <td><?php echo $details[0]['OPENING_NO'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Level</th>
                                        <td><?php echo $details[0]['FUNCTIONAL_LEVEL_EDESC'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Service/Group</th>
                                        <td><?php echo $details[0]['SERVICE_TYPE_NAME'].' / '.$details[0]['SERVICE_EVENT_NAME'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Post</th>
                                        <td><?php echo $details[0]['DESIGNATION_TITLE'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Department</th>
                                        <td><?php echo $details[0]['DEPARTMENT_NAME'] ?></td>
                                    </tr>
                                    <?php if(!empty($details[0]['EXPERIENCE'])){
                                        echo '<tr><th>Experiance</th><td>'. $details[0]['EXPERIENCE'].' Years </th></tr>';
                                    }
                                    ?>
                                    <tr>
                                        <th>Image File</th>
                                        <td><a target="_blank" href="<?php echo base_url().'../hana-noc/neo-hris/public/uploads/noc_documents/' . $details[0]['FILE_IN_DIR_NAME']; ?>">Here</a></td>
                                    </tr>
                                </table>
                                <?php if(!empty($details[0]['JOB_SPECIFICATION'])) {
                                    echo '<h6 class="vacancy-subTitle">Job Specification</h6><p>' .$details[0]['JOB_SPECIFICATION']. '</p>';
                                } if(!empty($details[0]['RESPONSIBILITY'])) {
                                    echo '<h6 class="vacancy-subTitle">Job Responsibility</h6><p>' .$details[0]['RESPONSIBILITY']. '</p>';
                                } if(!empty($details[0]['ROLES'])) {
                                    echo '<h6 class="vacancy-subTitle">Job Roles</h6><p>' .$details[0]['ROLES']. '</p>';
                                } 
                                ?>
                            </div>
                            <hr>
                            <?php $vid = base64_encode($details[0]['VACANCY_ID']);
                            if ($this->VacancyModel->checkapplied($details[0]['VACANCY_ID'], $this->session->userdata('userId')) == false) {  
										echo '<a class="btn btn-primary btn-noc" href="' . base_url("vacancy/apply/") . $vid . '" role="button">Apply Now</a>';
									} else {
										echo '<a class="btn btn-primary btn-noc" href="' . base_url("vacancy/edit/") . $vid . '" role="button">Edit</a>';
									} ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>