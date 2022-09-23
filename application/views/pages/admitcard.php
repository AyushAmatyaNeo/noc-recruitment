<!DOCTYPE html>
<html lang="en">        
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="icon" href="<?php echo base_url() ?>assets/images/favicon.png" type="image/gif" sizes="32x32">
        <title>NOC | Admit Card</title>
        <link rel="icon" href="http://noc.org.np/assets/noc-f4bc4277383043f1536e899f46af9498.png" type="image/gif" sizes="32x32">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            .card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0,0,0,.125);
            border-radius: .25rem;
            }
            .card-body{
                -ms-flex: 1 1 auto;
                flex: 1 1 auto;
                min-height: 1px;
                padding: 1rem;
            }
            table, td, th {
                border: 1px solid black;
              }
            p{
              font-size: 12px;
            }
        </style>
    </head>
    <body>  
             
          <div class="card">
            <div class="card-body">
               <div class="row" style="text-align: center;">
                <div class="col-md-12">
                  <h6>Nepal Oil Corporation Limited</h6>
                </div>
               </div>
               <div class="row" style="margin-bottom: -85px;">
                  <div class="col-md-8" style="text-align: center; position:relative;">
                      <h6 style="margin-bottom: -15px;"><?php echo $officename['DESCRIPTION_NDESC'] ?> </h6> <br>
                      <p style="font-size: 14px;">Internal Examination admit card <br>
                        written Exam
                      </p> 
                      <strong style="position:absolute; left:0px;">Roll No. : <?php echo $vacancydata[0]['ROLL_NO'] ?></strong><br>
                      <strong style="position:absolute; left:0px;">Name in Nepali :- <?php echo $vacancydata[0]['FIRST_NAME'].'&nbsp;'.$vacancydata[0]['MIDDLE_NAME'].'&nbsp;'.$vacancydata[0]['LAST_NAME'] ?></strong><br>
                      <strong style="position:absolute; left:0px;">Name in English :- <?php echo $vacancydata[0]['FIRST_NAME'].'&nbsp;'.$vacancydata[0]['MIDDLE_NAME'].'&nbsp;'.$vacancydata[0]['LAST_NAME'] ?></strong>
                  </div>
                  <div class="col-md-4" style="text-align: right;">

                    <img src="<?php foreach($documentdata as $data) {
                      if ($data['DOC_FOLDER'] == 'photograph') {
                        echo $data['DOC_PATH'];
                      }
                    } ?>" style="height: 120px; width:120px">
                  </div>
               </div>
               <div class="row" style="margin-bottom: -320px;">
                  <div class="table-shortdes" style="width: 60%; word-wrap: break-word;">
                      <table style="border-collapse: collapse; width:100%; margin-bottom:10px;">
                            <tr>
                              <td style="width: 30%;">Ad No.</td>
                              <td><?php echo $vacancydata[0]['AD_NO'] ?></td>
                            </tr>
                            <tr>
                              <td style="width: 30%;">Job/Level</td>
                              <td><?php echo $vacancydata[0]['DESIGNATION_TITLE'].'/'.$vacancydata[0]['FUNCTIONAL_LEVEL_EDESC']?></td>
                            </tr>
                            <tr>
                              <td style="width: 30%;">Service/Group</td>
                              <td><?php echo $vacancydata[0]['SERVICE_TYPE_NAME'].'/'.$vacancydata[0]['SERVICE_TYPE_NAME']?></td>
                            </tr><tr>
                              <td style="width: 30%;">Application From</td>
                              <td>OPEN</td>
                            </tr><tr>
                              <td style="width: 30%;">Citizenship No.</td>
                              <td><?php echo $vacancydata[0]['CITIZENSHIP_NO']?></td>
                            </tr>
                      </table>
                      <p><?php echo $shortinstructions['DESCRIPTION_NDESC'] ?></p>
                  </div>
                 <div class="col-md-5" style="text-align:right; margin-top:100px;">
                    <img src="<?php foreach($documentdata as $data) {
                      if ($data['DOC_FOLDER'] == 'nagrita_front') {
                        echo $data['DOC_PATH'];
                      }
                    } ?>" style=" height: 160px; width:260px; text-align:right"><br> <br>
                    <img src="<?php foreach($documentdata as $data) {
                      if ($data['DOC_FOLDER'] == 'nagrita_back') {
                        echo $data['DOC_PATH'];
                      }
                    } ?>" style=" height: 160px; width:260px; text-align:right">
                 </div>
               </div>
               <div class="row" style="margin-top: -80px;">
                  <div class="table-table" style="width: 65%; word-wrap: break-word;">
                      <table style="border-collapse: collapse; width:95%; margin-bottom:10px;">
                            <tr>
                              <th style="width: 25px;">S.N.</td>
                              <th style="width: 120px;">Patra</th>
                              <th>Patra</th>
                            </tr>
                            <tr>
                              <td>1</td>
                              <td>First</td>
                              <td>2076 12 anamnanagar</td>
                            </tr>
                            <tr>
                              <td>1</td>
                              <td>nbjf nb</td>
                              <td>Lorem Ipsum Lorem Ipsum Lorem Ipsum</td>
                            </tr>
                          
                      </table>
                  </div>
               </div>
              <div class="row" style="margin-top: -140px;">
                <div class="col-md-12" style="text-align:right;">
                <img src="<?php foreach($documentdata as $data) {
                      if ($data['DOC_FOLDER'] == 'signature') {
                        echo $data['DOC_PATH'];
                      }
                    } ?>" style=" height: 100px; width:110px;"> &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <img src="https://cdn.pixabay.com/photo/2021/08/03/20/36/plants-6520443_960_720.jpg" style=" height: 100px; width:100px;"> <br>
                  <p>Applicant Signature &nbsp; &nbsp; &nbsp;&nbsp;&nbsp; Authorized Signature</p>
                </div>
              </div>
              <br>
              <div class="row">
                <div class="ruless" style="position:relative">
                <strong>Rules to be followed</strong> 
                <?php echo $longinstructions['DESCRIPTION_NDESC'] ?>
              </div>
              </div>
            </div>
            
          </div> 
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>   

