<main class="main-vacancy-detail sec-padd bg-light">
    <section class="vacancy-detail-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="vacancy-detail-inner card">
                        <div class="card-body">
                            <div class="vacancy-detail-top">
                                <img class="rounded float-left" width="6%" src="http://localhost/noc-recruitment/assets/images/noc-logo-footer.png" alt="nepal_oil_logo"  />
                                <h5>Please check the vacany details below:</h5>
                                <div class="vacancy-date">
                                    <small><i class="fa fa-calendar" aria-hidden="true"></i> Last Date: <?php echo $details[0]['END_DATE'] ?></small>
                                    <small><i class="fa fa-calendar" aria-hidden="true"></i> Extended Date: <?php echo $details[0]['EXTENDED_DATE'] ?></small>
                                </div>
                            </div>
                            <hr>
                            <div class="vacancy-detail-content"> 
                            <h6 class="vacancy-subTitle">Opening Instruction:</h6>
                                    <p><?php echo $details[0]['OPENING_INSTRUCTION'] ?></p>                            
                                <h6 class="vacancy-subTitle">Vacancy Notes:</h6>
                                    <p><?php echo $details[0]['REMARK'] ?></p>
                                <h6 class="vacancy-subTitle">Basic Job Information</h6>
                                <table class="table w-75 p-3 table-striped table-bordered ">
                                <tr>
                                        <th>Opening No : सूचना संख्या</th>
                                        <td><?php echo $details[0]['OPENING_NO'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Advertisement No : विज्ञापन संख्या</th>
                                        <td><?php echo $details[0]['AD_NO'] ?></td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Level : तह </th>
                                        <td><?php echo $details[0]['FUNCTIONAL_LEVEL_EDESC'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Service/Group : सेवा / समूह</th>
                                        <td><?php echo $details[0]['SERVICE_TYPE_NAME'].' / '.$details[0]['SERVICE_EVENT_NAME'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Post : पद </th>
                                        <td><?php echo $details[0]['DESIGNATION_TITLE'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Department : विभाग</th>
                                        <td><?php echo $details[0]['DEPARTMENT_NAME'] ?></td>
                                    </tr>
                                    <?php if(!empty($details[0]['EXPERIENCE'])){
                                        echo '<tr><th>Experience : अनुभव</th><td>'. $details[0]['EXPERIENCE'].' Years </th></tr>';
                                    }
                                    ?>
                                    <tr>
                                        <th>Skills : खुबि </th>
                                        <td>
                                        <?php $c = 1;
                                            if ($details[0]['SKILL_ID'] != "") {
                                                foreach($details[0]['SKILL_ID'] as $skillName) { 
                                            
                                                
                                        ?>                                        
                                        <?php echo '   '.$c .'. '. $skillName['SKILL_NAME'].'</br>'?>                                        
                                        <?php $c++; } }?>
                                       </td>
                                    </tr>
                                    <tr>
                                        <th>Inclusions : समावेशहरू</th>
                                        <td>
                                       <?php $c = 1; 
                                       if ($details[0]['INCLUSION_ID'] != "") {
                                       foreach($details[0]['INCLUSION_ID'] as $skillName) { ?>                                        
                                        <?php echo '   '.$c .'. '. $skillName['OPTION_EDESC'].'</br>'?>                                        
                                        <?php $c++; } }?>
                                       </td>
                                    </tr>
                                    <tr>
                                        <th>Attachement file</th>
                                        <td><a target="_blank" href="<?php echo base_url().'../hana-noc/neo-hris/public/uploads/noc_documents/' . $details[0]['FILE_IN_DIR_NAME']; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-pdf" viewBox="0 0 16 16">
                                                <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1z"/>
                                                <path d="M4.603 12.087a.81.81 0 0 1-.438-.42c-.195-.388-.13-.776.08-1.102.198-.307.526-.568.897-.787a7.68 7.68 0 0 1 1.482-.645 19.701 19.701 0 0 0 1.062-2.227 7.269 7.269 0 0 1-.43-1.295c-.086-.4-.119-.796-.046-1.136.075-.354.274-.672.65-.823.192-.077.4-.12.602-.077a.7.7 0 0 1 .477.365c.088.164.12.356.127.538.007.187-.012.395-.047.614-.084.51-.27 1.134-.52 1.794a10.954 10.954 0 0 0 .98 1.686 5.753 5.753 0 0 1 1.334.05c.364.065.734.195.96.465.12.144.193.32.2.518.007.192-.047.382-.138.563a1.04 1.04 0 0 1-.354.416.856.856 0 0 1-.51.138c-.331-.014-.654-.196-.933-.417a5.716 5.716 0 0 1-.911-.95 11.642 11.642 0 0 0-1.997.406 11.311 11.311 0 0 1-1.021 1.51c-.29.35-.608.655-.926.787a.793.793 0 0 1-.58.029zm1.379-1.901c-.166.076-.32.156-.459.238-.328.194-.541.383-.647.547-.094.145-.096.25-.04.361.01.022.02.036.026.044a.27.27 0 0 0 .035-.012c.137-.056.355-.235.635-.572a8.18 8.18 0 0 0 .45-.606zm1.64-1.33a12.647 12.647 0 0 1 1.01-.193 11.666 11.666 0 0 1-.51-.858 20.741 20.741 0 0 1-.5 1.05zm2.446.45c.15.162.296.3.435.41.24.19.407.253.498.256a.107.107 0 0 0 .07-.015.307.307 0 0 0 .094-.125.436.436 0 0 0 .059-.2.095.095 0 0 0-.026-.063c-.052-.062-.2-.152-.518-.209a3.881 3.881 0 0 0-.612-.053zM8.078 5.8a6.7 6.7 0 0 0 .2-.828c.031-.188.043-.343.038-.465a.613.613 0 0 0-.032-.198.517.517 0 0 0-.145.04c-.087.035-.158.106-.196.283-.04.192-.03.469.046.822.024.111.054.227.09.346z"/>
                                                </svg>  Click Here</a></td>
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
                            <h6 class="vacancy-subTitle">Opening Notes:</h6>
                                <p><?php echo $details[0]['OPENING_NOTES'] ?></p>
                            <hr>
                            <?php $vid = base64_encode($details[0]['VACANCY_ID']);
                            if ($this->VacancyModel->checkapplied($details[0]['VACANCY_ID'], $this->session->userdata('userId')) == false) {
                                // var_dump('hrber'); die; 
                               
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