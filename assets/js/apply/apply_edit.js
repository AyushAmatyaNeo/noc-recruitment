$(document).ready(function () {
  // console.log('here');
  // Disable Future Dates
  $('.selectNepaliDate').nepaliDatePicker({
    // endDate: new Date()
  });

  //END
  // Total Days in training tab
  $('.period').on('click', function () {
    let fromdate = new Date($('.tr_from_date').val());
    let todate = new Date($('.tr_to_date').val());
    var Difference_In_Time = todate.getTime() - fromdate.getTime();
    // To calculate the no. of days between two dates
    var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
    $('.period').val(Difference_In_Days);
    if (Difference_In_Days <= 0) {
      alert('To Date cannot be same or less than From Date.')
    }
  });
  jQuery.validator.addMethod("exactlength", function (value, element, param) {
    return this.optional(element) || value.length == param;
  }, $.validator.format("Please enter exactly {0} characters."));
  jQuery.validator.addMethod("passed_years", function (value, element, param) {
    return this.optional(element) || value <= param;
  }, $.validator.format("Please enter Valid Year."));

  $.validator.addMethod('GPA', function (value, el, param) {
    var rank_type = $('#rank_type').val();
    if(rank_type == 'GPA'){
      console.log(rank_type);
      return value > param;
    }else{
     
      return true;
    }
}, $.validator.format("Please enter above {0}."));


  var data = {
    // Specify validation rules
    rules: {
     
      'inclusion[]'    : "required",
      'inclusion_id[]'    : "required",
      'skills[]': "required",
      // Organisation 
      'org_name[]'     : "required",
      'post_name[]'    : "required",
      'service_name[]' : "required",
      'org_level[]'    : "required",
      'employee_type[]': "required",
      'from_date[]'   : "required",
      'to_date[]'     : "required",
      //Education
      'max_education' : "required",
      'edu_institute[]': "required",
      'level_id[]': 'required',
      'facalty[]': "required",
      'rank_type[]': "required",
      'university_board[]': "required",
      'rank_value[]': {
        required: true,
        number: true,
        GPA: 1,
      },
      'major_subject[]': "required",
      'passed_year[]': {
        required: true,
        digits: true,
        exactlength: 4,
        // passed_years: new Date().toString().match(/(\d{4})/)[1]
      },
      // Training
      'training_name[]': "required",
      'certificate[]'  : "required",
      'tr_from_date[]' : "required",
      'tr_to_date[]': {
        required: true,
        // "to_date" : new Date($('.tr_to_date').val())
      },
      'period[]'       : "required",
      'description[]'  : "required",
      // Files
      nagrita_front: "required",
      nagrita_back: "required",
      recent_photo: "required",
      signature: "required",
      right_finger_scan: "required",
      left_finger_scan: "required",
      'School': "required",
      'SLC': "required",
      'higher Secondary School': "required",
      'Bachlor': "required",
      'Master': "required",
      'M.Phil': "required",
      
    },
    // Specify validation error messages
    messages: {
      marital: "Matial name is required",
      employment: "employment is required",
      disability: "Disability is required",
      mother_tongue: "mother_tongue is required",
      fatherEdu: "Father Education is required.",

      grandfather_name: "Grandfather Name is required",
      grandfather_nationality: "Grandfather Nationality is required",
      spouse_name: "Spouse Name is required",
      spouse_nationality: "Spouse Nationality is required",
      fatherEdu: "Father Qualification is required",
      motherEdu: "Mother Qualification is required",
      fmoccupation: "Occupation is required",
      'org_name[]': "Organisation Name is required",
      'passed_year[]': {
        required: "Passed Year is required",
        digits: "Please enter Number only",
        exactlength: "Please enter Valid Year"

      },
      'rank_value[]': {
        required: "Rank type is Required",
        digits: "Please enter Number only",
      }
    },
  }
  $("#applyForm").multiStepFormapply(
    {
      defaultStep: 0,
      beforeSubmit: function (form, submit) {
        console.log("called before submiting the form");
        console.log(form);
        console.log(submit);
      },
      validations: data,
      errorPlacement: function (error, element) {
        error.insertBefore(element.closest('td'));
      }
    }
  ).navigateTo(0);

  // Educational Qualification Section START-------------------------------xxxxxxxxxxxxx-----------------------
  var max_fields_edu = 5; // Maximum input fields
  var t_education = $('#educationalbody');
  var btn_edu_remove = $('.btn-edu-remove');
  var btn_add_edu = $('.btn-add-edu');
  var appendDataedu =
    `<tr>
        <td>
          <div for="edu_institute" class="form-group">
            <input type="text" name="edu_institute[]" class="form-control form-control-sm">
          </div>
				</td>
				<td>
            <select name="level_id[]" class="form-control" id = "levelIddd">
                
            </select>
				</td>
        <td>
          <div for="facalty" class="form-group">
            <select name="facalty[]" class="form-control" id = "faculties">
                    
              </select>
          </div>
        </td>

        <td>
          <div class="form-group">
              <select class="form-control form-control-sm" id="" name="rank_type[]">
                  <option value="">---</option>
                  <option value="GPA">GPA</option>
                  <option value="Percentage">Percentage</option>
              </select>
          </div>
        </td>
        <td>
            <div for="rank_value" class="form-group">
                <input type="text" name="rank_value[]" class="form-control form-control-sm">
            </div>
        </td>
        <td>
          <div for="univerity_board" class="form-group" id="rank_value_error">
              <select name="univerity_board[]" class="form-control" id = "univs">
                    
              </select>
          </div>
				</td>
				<td>
          <div for="major_subject" class="form-group">
              <select name="major_subject[]" class="form-control" id = "majorsub">
                    
              </select>
          </div>
        </td>
        <td>
          <div for="passed_year" class="form-group">
            <input type="number" name="passed_year[]" class="form-control form-control-sm">
          </div>
				</td>
        <td>
          <i class="fa fa-minus-circle btn-edu-remove" aria-hidden="true" style="color: red; cursor: pointer"></i>
        </td>
			</tr>`;
      
  $(btn_add_edu).click(function (e) {
    e.preventDefault();
    var edu_len = $(document).find('#educationalbody > tr').length;
    if (edu_len < 5) {
      (t_education).append(appendDataedu);
        var options = $('#educationalbody #levelIddd');
        options.empty();
        // options.append(new Option("-- Select --", 0));
        $.each(document.levellist, function () {
            options.append(new Option(this.ACADEMIC_DEGREE_NAME, this.ACADEMIC_DEGREE_ID));
        });
        var options = $('#educationalbody #majorsub');
        options.empty();
        
        $.each(document.majors, function () {
          options.append(new Option(this.ACADEMIC_COURSE_NAME, this.ACADEMIC_COURSE_ID));
        });
        var options = $('#educationalbody #univs');
        options.empty();
        
        $.each(document.univs, function () {
          options.append(new Option(this.ACADEMIC_UNIVERSITY_NAME, this.ACADEMIC_UNIVERSITY_ID));
        });
        var options = $('#educationalbody #faculties');
        options.empty();
        
        $.each(document.faculties, function () {
          options.append(new Option(this.ACADEMIC_PROGRAM_NAME, this.ACADEMIC_PROGRAM_ID));
        }); 
    }
     
  });
  // Educational Qualification Section END-------------------------------xxxxxxxxxxxxx-----------------------
  // H. Experience Detail START ------------------------------------------xxxxxxxxxxxxx-----------------------
  var max_fields_exp = 5; // Maximum input fields
  var t_experiance = $('#experiancebody');
  var btn_exp_remove = $('.btn-exp-remove');
  var btn_add_exp = $('.btn-add-exp');
  var tr_id = 1;
  var y = 1; // initial row value
  
  $(document).on("click", '.btn-add-exp', addexprow);

  function addexprow(e) {
    e.preventDefault();
    if (y < max_fields_exp) {
      // alert(x);
      var appendDataexp =
                `<tr>
                      <td>
                          <div for="org_name" class="form-group">
                              <input type="text" name="org_name[]" class="form-control form-control-sm">
                          </div>
                      </td>
                      <td>
                          <div for="post_name" class="form-group">
                              <input type="text" name="post_name[]" class="form-control form-control-sm">
                          </div>
                      </td>
                      <td>
                          <div for="service_name" class="form-group">
                              <input type="text" name="service_name[]" class="form-control form-control-sm">
                          </div>
                      </td>
                      <td>
                          <div for="org_level" class="form-group">
                              <input type="number" name="org_level[]" class="form-control form-control-sm">
                          </div>
                      </td>
                      <td>
                          <div for="employee_type" class="form-group">
                              <select name="employee_type[]" class="form-control form-control-sm">
                                  <option></option>
                                  <option value="1">Permanent</option>
                                  <option value="2">Temporary</option>
                                  <option value="3">Contract</option>
                              </select>
                          </div>
                      </td>
                      <td>
                          <div for="from_date1" class="form-group">
                            <input type="text" class="form-control  from_date_bs`+y+`" name="from_date_bs[]" id="from_date_bs`+y+`" placeholder="Start Date)">
                              <input type="text" class="form-control from_date_ad`+y+`" name="from_date[]" id="from_date_ad`+y+`" placeholder="End Date" readonly>                                        
                          </div>
                      </td>
                      <td>
                          <div for="to_date1" class="form-group">
                            <input type="text" class="form-control to_date_bs`+y+`" name="to_date_bs[]" id="to_date_bs`+y+`" placeholder=" Start Date">
                            <input type="text" class="form-control  to_date_ad`+y+`" name="to_date[]" id="to_date_ad`+y+`" placeholder="End Date" readonly>                                        
                          </div>
                      </td>
                      <td>
                          <i class="fa fa-minus-circle btn-exp-remove" aria-hidden="true" style="color: red; cursor: pointer"></i>
                      </td>
              </tr>`;
      $(t_experiance).append(appendDataexp);
      app.startEndDatePickerWithNepali('from_date_ad'+y, 'from_date_bs'+y, 'to_date_ad'+y, 'to_date_bs'+y);
      // app.startEndDatePickerWithNepali('from_date_bs'+y, 'from_date_ad'+y, 'to_date_bs'+y, 'to_date_ad'+y);
      $(document).on("change", '.from_date_bs'.y, function(){
        var totalExpDays = 0;
        for(var ai = 1;ai<y;ai++){
          var diff = Math.floor(( Date.parse($('#to_date_bs'+ai).val()) - Date.parse($('#from_date_bs'+ai).val()) ) / 86400000);
          totalExpDays = totalExpDays + diff
        }
          let months = 0, years = 0, days = 0, weeks = 0;
          while(totalExpDays){
              if(totalExpDays >= 365){
                years++;
                totalExpDays -= 365;
              }else if(totalExpDays >= 30){
                months++;
                totalExpDays -= 30;
              }else if(totalExpDays >= 7){
                weeks++;
                totalExpDays -= 7;
              }else{
                days++;
                totalExpDays--;
              }
          }
          $('#yourTotalExp').val(years + ' Years ' + months + ' Months ' + weeks + ' Weeks ' + days + ' Days ');
      });
      y++; 
      
    }
  }
  
  $(t_experiance).on("click", ".btn-exp-remove", function (e) {
    e.preventDefault();
    $(this).closest('tr').remove();
    y--;
  });
  // H. Experience Detail END ------------------------------------------xxxxxxxxxxxxx-----------------------

  // I. Training Detail START ------------------------------------------xxxxxxxxxxxxx-----------------------
  var max_fields_trn = 5; // Maximum input fields
  var t_training = $('#trainingbody');
  var btn_tr_remove = $('.btn-tr-remove');
  var btn_add_tr = $('.btn-add-tr');
 
  var z = 1; // initial row value                       
  $(btn_add_tr).click(function (e) {
    e.preventDefault();
    if (z < max_fields_trn) {
      // alert(x);
      var appendDatatr =
        `<tr>
                              <td>
                              <div for="training_name" class="form-group">
                                  <input type="text" name="training_name[]" class="form-control form-control-sm">
                              </div>
                              </td>
                              <td>
                                  <div for="certificate" class="form-group">
                                      <input type="text" name="certificate[]" class="form-control form-control-sm">
                                  </div>
                              </td>
                              <td>
                                  <div for="tr_from_date" class="form-group">
                                      
                                      <input type="text" name="tr_from_date[]" id="tr_from_date_bs`+z+`" onchange = "getPeriodTrainingFromDays(`+z+`)" class="form-control form-control-sm tr_from_date_bs" placeholder="Start Date" />
                                      <input type="text" name="tr_from_date_bs" id="tr_from_date_ad`+z+`"  class="form-control form-control-sm tr_from_date" placeholder="End Date" readonly/>
                                  </div>
                              </td>
                              <td>
                                  <div for="tr_to_date" class="form-group">                                   
                                      <input type="text" name="tr_to_date[]" id="tr_to_date_bs`+z+`" onchange = "getPeriodTrainingToDays(`+z+`)" class="form-control form-control-sm  tr_to_date_bs" placeholder="Start Date" />
                                      <input type="text" name="tr_to_date_bs" id="tr_to_date_ad`+z+`"  class="form-control form-control-sm tr_to_date" placeholder="End Date" readonly />
                                  </div>
                              </td>
                              <td>
                                <div for="periodn" class="form-group">    
                                    <input type="text" name="periodn" id="periodn`+z+`" class="form-control form-control-sm periodn" placeholder="period" readonly />
                                </div>
                              </td>
                              <td>
                                  <div for="description" class="form-group">
                                      <input type="text" name="description[]" class="form-control form-control-sm">
                                  </div>
                              </td>
                              <td>
                                  <i class="fa fa-minus-circle btn-tr-remove" aria-hidden="true" style="color: red; cursor: pointer"></i>
                              </td>
                          </tr>`;
      $(t_training).append(appendDatatr);
      app.startEndDatePickerWithNepali('tr_from_date_ad'+z, 'tr_from_date_bs'+z, 'tr_to_date_ad'+z, 'tr_to_date_bs'+z);
      z++;
    }
  });
  $(t_training).on("click", ".btn-tr-remove", function (e) {
    e.preventDefault();
    $(this).closest('tr').remove();
    z--;
  });
  // I. Training Detail END ------------------------------------------xxxxxxxxxxxxx-----------------------

  // Document Upload Section code
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#photograph').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }
  function readURLSign(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#recent_sign').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }
  function readURLright(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#right_finger').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }
  function readURLleft(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#left_finger').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }
  //Nagrita
  function readnagritafront(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#nagrita_front').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  function readnagritaBack(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function (e) {
        $('#nagrita_back').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }


  $("#recent_photo").change(function () {
    readURL(this);
  });
  $("#signature").change(function () {
    readURLSign(this);
  });
  $("#right_finger_scan").change(function () {
    readURLright(this);
  });
  $("#left_finger_scan").change(function () {
    readURLleft(this);
  });

  //   Nagrita upload
  $("#nagrita_frontimg").change(function () {
    readnagritafront(this);
  });
  $("#nagrita_backimg").change(function () {
    readnagritaBack(this);
  });

  //   Others -> input Fields required
  $('input[type=radio][name=employment]').on('change', function () {
    // alert ('dHello');
    if (this.value == 'others') {
      $("input[name='employment_input']").prop('required', true);
    }
    else {
      $("input[name='employment_input']").removeAttr('required');
    }
  });

  $('input[type=radio][name=disability]').on('change', function () {
    // alert ('dHello');
    if (this.value == 'Yes') {
      $("input[name='disability_input']").prop('required', true);
    }
    else {
      $("input[name='disability_input']").removeAttr('required');
    }
  });

  $('.inclusion').on('change', function () {
    // console.log('here');
    var val = [];
    $('.inclusion:checked').each(function (i) {
      val[i] = $(this).val();
    });
    console.log(val);
    var level_id = $('#functional_level_id').val();
    var position_id = $('#position_id').val();
    var baseurl = $('#baseurl').val();
    if (val != '') {
      $.ajax({
        type: "POST",
        url: baseurl + "vacancy/inclusionamount/",
        data: { level_id: level_id, position_id: position_id },
        success: function (success) {
          var response = jQuery.parseJSON(success);
          var now = new Date();
          console.log(response.NORMAL_AMOUNT);
          console.log(response);
          var year = now.getFullYear();
          var month = now.getMonth() + 1;
          var day = now.getDate();
          month = (month < 10) ? (month = "-0" + month) : month;
          day = (day < 10) ? (day = "-0" + day) : day;
          var Unix_today = new Date(year+'-'+month+'-'+day).getTime() / 1000;
          Unix_end = new Date(response.END_DATE).getTime() / 1000;
          console.log(new Date('2022-10-15').getTime() / 1000);
          console.log(new Date('2022-10-16').getTime() / 1000);

          if (val.length == 1) {
            if (Unix_end <= Unix_today) {
              $('#inclusion_amount').val(response.LATE_AMOUNT);
            } else {
              $('#inclusion_amount').val(response.NORMAL_AMOUNT);
            }

          } else {
            if (Unix_end <= Unix_today) {
              let total = parseInt(response.LATE_AMOUNT) + parseInt(response.INCLUSION_AMOUNT) * (val.length - 1);
              $('#inclusion_amount').val(total);
            } else {
              let total = parseInt(response.NORMAL_AMOUNT) + parseInt(response.INCLUSION_AMOUNT) * (val.length - 1);
              $('#inclusion_amount').val(total);
            }
          }
        }
      });
    } else {
      // alert('No value');
      $('#inclusion_amount').val('');
    }
  });

  $("#expcalculate").on('click', function () {
    var fromDate = new Date($('.fromDate').val());
    let fDateYear = fromDate.getFullYear();
    let fDateMonth = fromDate.getMonth();
    let fDateDay = fromDate.getDay();

    var toDate = new Date($('.toDate').val());
    let tDateYear = toDate.getFullYear();
    let tDateMonth = toDate.getMonth();
    let tDateDay = toDate.getDay();

    // var diff = toDate - fromDate;
    var totalDays = parseInt((toDate - fromDate) / (24 * 3600 * 1000));
    var Days, Months, years;
    if (totalDays <= 365) {
      years = 0;
      Months = parseInt(totalDays / 30);
      if (Months == 12) {
        Months = 0;
      }
      Days = parseInt((totalDays * 12) / 365);
    } else {
      years = (tDateYear - fDateYear);
      Months = parseInt(totalDays / 30.417); //parseInt((toDate-fromDate)/(24*3600*1000*30*12));
      if (totalDays <= 359) {
        Months = 0;
      }
      Days = parseInt((totalDays * 12) / 365);

    }

    $('.years').val(years);
    $('.months').val(Months);
    $('.days').val(Days);

    console.log(totalDays);
    console.log((tDateMonth + 12 * tDateYear) - (fDateMonth + 12 * fDateYear));


    // console.log(years);
    // console.log(Months);
    // console.log(Days);
    // console.log(checkClass());
  });


  $('.certUpload').on('click', addUpload);

  function addUpload() {
    var InputName = $(this).closest('tr').find('td:eq(2) input').attr('name');
    // console.log(InputName);
    var uploadRow = `
  <div><input type="file" class="form-control-file" name="`+ InputName + `" required ="required"/>
  <i class="fa fa-minus-circle btn-cert-remove"  role="button" aria-hidden="true" style="color: red; cursor: pointer"></i></div>`;
    $(this).closest('tr').find('td:eq(2)').append(uploadRow);
  }
  $(document).on("click", ".btn-cert-remove", delUpload);
  function delUpload() {
    var selector = $(this).closest('div');
    var conf = confirm('Are you sure want to delete?');
    if (conf) {
      selector.detach();
    }
  }
  // Add required if skill checkbox selected
  $('.skills').on('click', function () {
    if ($(this).closest(".skills").is(":checked")) {
      var Input = $(this).attr('skillname');
      console.log(Input);
      // console.log("Checkbox is checked.");
      $('input[name="' + Input + '"]').attr("required", true);
    } else {
      var Input = $(this).attr('skillname');
      // console.log("Checkbox is unchecked.");
      $('input[name="' + Input + '"]').removeAttr("required");
    }
  });
  // Add required if skill checkbox selected
  $('.inclusion').on('click', function () {
    console.log('asdf');
    if ($(this).closest(".inclusion").is(":checked")) {
      var Input = $(this).attr('inclusionName');
      console.log(Input);
      // console.log("Checkbox is checked.");
      $('input[name="' + Input + '"]').attr("required", true);
    } else {
      var Input = $(this).attr('inclusionName');
      $('input[name="' + Input + '"]').removeAttr("required");
    }
  });
  // Nepali date select
  function myFunction() {
    // var trDateInput = document.getElementsByClassName("selectNepaliDate");
    var trDateInput = $('#from_date_ad1');
    console.log(trDateInput);           
    trDateInput.nepaliDatePicker({
      dateFormat:"YYYY-MM-DD",
      // disableDaysAfter: "2077-12-10",
      ndpYear: true,
      ndpMonth: true
    });
};

});
function getPeriodTrainingFromDays(params) {
  // let fromdate = new Date($('#tr_from_date_bs'+params).val());
  var fromdateid = '#tr_from_date_bs'+params;
  var todateid = '#tr_to_date_bs'+params;
  let fromdate = new Date($(fromdateid).val());
  let todate = new Date($(todateid).val());
  var Difference_In_Time = todate.getTime() - fromdate.getTime();
  var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
  // if (Difference_In_Days > 364) {
    
  // } else if(condition) {
    
  // }

  var Difference_In_Years = Difference_In_Days/30;
  var Difference_In_Years=parseFloat(Difference_In_Years).toFixed(0);
  console.log(Difference_In_Years);
  if (Difference_In_Years >  0) {
    Difference_In_Years = Difference_In_Years +' Months'
    $('#periodn'+params).val(Difference_In_Years) ; 
  }
  
  // console.log(Difference_In_Days);
 

}
function getPeriodTrainingToDays(params) {
 console.log('sdcnsjd');
}




