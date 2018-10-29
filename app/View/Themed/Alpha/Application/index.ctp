<?php $myapptype = $this->Session->read('Application.AppType'); ?>

<div id="p2_sec01_wrap">
  <div class="container">
      <div class="row">
          <div class="col-sm-12">
                <div class="ws_subpg_hd_txt" id='by_default_msg'>
                <?php 
                if(strpos($myapptype,'payday') !== false){
                  echo 'Lenders online now with up to $1,000 to deposit in your account by <span class="orng">tomorrow!</span>';
                }else{
                  echo 'Your better credit gets you <strong>larger loan amounts</strong> and <strong>better repayment terms</strong>';
                }?>

                </div>
                <div class="ws_subpg_hd_txt" id ="msg_dis" style="display: none">
                  <?php 
                    echo 'Lenders online now with up to $1,000 to deposit in your account by <span class="orng">tomorrow!</span>';
                  ?>

                </div>

            </div>
        </div>
    </div>
</div>
<div id="formwrapper" class="container">
  <div class="row">
      <div class="col-sm-12">
          <form method="post" id="basicWizard" class="panel-wizard">
      <input type="hidden" id="AppType" value="<?php echo $this->Session->read('Application.AppType');?>">
      <input type="hidden" id="IPAddress" value="<?php echo $this->Session->read('Application.IPAddress');?>">
      <input type="hidden" id="Url" value="<?php echo $this->Session->read('Application.Url');?>">
              <ul id="applicationtabnav" class="nav nav-justified nav-wizard">
                  <li id="li1"><a href="#tab1" data-toggle="tab">Personal Info</a></li>
                  <li id="li2"><a href="#tab2" data-toggle="tab">Verify Identity</a></li>
                  <li id="li3"><a href="#tab3" data-toggle="tab">Employment Info</a></li>
                  <li id="li6" <?php if($this->Session->read('Application.CoApplicant') == 'No' || $this->Session->check('Application.CoApplicant') == false || strpos($myapptype,'payday') !== false){echo "style='display:none'";}?>><a href="#tab6" data-toggle="tab">Co-Applicant</a></li>
                  <li id="li4"><a href="#tab4" data-toggle="tab">Deposit Cash</a></li>
                  <li id="li5"><a href="#tab5" data-toggle="tab">Finalize</a></li>
                  <li id="li7"><a href="#tab7" data-toggle="tab"></a></li>
              </ul>
              <div class="tab-content <?php if(strpos($myapptype,'payday') !== false){echo 'payday'; }else{echo $this->Session->read('Application.AppType');}?>">
                  <div class="tab-pane tab1" id="tab1">
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="p2_sectionhd">Tell Us More About Yourself</div>
                          </div>
                      </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <label for="LoanAmount">Desired Loan Amount</label>
            <select name="LoanAmount" class="form-control" id="LoanAmount" tabindex="1" 
            data-parsley-required="true" 
            data-parsley-group="step1">
              <option value="">-Choose Amount-</option>
              <?php 
              foreach($LoanAmount as $key=>$value){
                $selected = '';
                if($this->Session->read('Application.LoanAmount') == $key){
                  $selected = ' selected="selected"';
                }
                
                if($key=='1001'){$key='600';}
                echo '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
              }
              ?>
            </select>
                        </div>
                      <div class="col-sm-4">
            <label for="FirstName">First Name:</label>
            <input name="FirstName" type="text" class="form-control" id="FirstName" tabindex="4" size="15" maxlength="50" value="<?php echo $this->Session->read('Application.FirstName'); ?>" placeholder="First Name" 
            data-parsley-required="true" 
            data-parsley-pattern="/^([a-zA-Z\s-\'\.]{2,50})$/" 
            data-parsley-group="step1"/>
                        </div>
                        <div class="col-sm-4">
            <label for="LastName">Last Name:</label>
            <input name="LastName" type="text" class="form-control" id="LastName" tabindex="6" size="15" maxlength="50"  value="<?php echo $this->Session->read('Application.LastName'); ?>" placeholder="Last Name" 
            data-parsley-required="true" 
            data-parsley-pattern="/^([a-zA-Z\s-\'\.]{2,50})$/" 
            data-parsley-group="step1"/>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
            <label for="Email">Email:</label>
            <input name="Email" type="email" class="form-control" id="Email" tabindex="7" size="20" maxlength="50"  value="<?php echo $this->Session->read('Application.Email'); ?>" placeholder="Email" 
            data-parsley-required="true" 
            data-parsley-pattern="/^[\w-]+(\.[\w-]+)*@([a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*?\.[a-zA-Z]{2,6}|(\d{1,3}\.){3}\d{1,3})(:\d{4})?$/" 
            data-parsley-group="step1"/>
                        </div>
                      <div class="col-sm-4">
            <label for="Address1">Address:</label>
            <input name="Address1" type="text" class="form-control" id="Address1" tabindex="8" size="20" maxlength="50"  value="<?php echo $this->Session->read('Application.Address1'); ?>" placeholder="Street Address" 
            data-parsley-required="true" 
            data-parsley-pattern="/^([a-zA-Z0-9\s-\'\.\,\_\#\&\/]{2,50})$/" 
            data-parsley-group="step1"/>
                        </div>
                      <div class="col-sm-4">
            <label for="Address2">Address 2 (if needed):</label>
            <input name="Address2" type="text" class="form-control" id="Address2" tabindex="8" size="20" maxlength="50"  value="<?php echo $this->Session->read('Application.Address2'); ?>" placeholder="Street Address" 
            data-parsley-pattern="/^([a-zA-Z0-9\s-\'\.\,\_\#\&\/]{1,50})$/" 
            data-parsley-group="step1"/>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                      <label for="City">City:</label>
            <input name="City" type="text" class="form-control" id="City" tabindex="10" size="20" maxlength="50"  value="<?php echo $this->Session->read('Application.City'); ?>" placeholder="City" 
            data-parsley-required="true" 
            data-parsley-pattern="/^([a-zA-Z\s-\.\']{1,50})$/" 
            data-parsley-group="step1"/>
                        </div>
                      <div class="col-sm-4">
            <label for="ResidenceType">Type of Residence:</label>
            <select name="ResidenceType" class="form-control" id="ResidenceType" tabindex="11" 
            data-parsley-required="true" 
            data-parsley-group="step1">
              <option value="">-Choose Type-</option>
              <option value="Rent"<?php echo ($this->Session->read('Application.ResidenceType') == 'Rent') ? ' selected="selected"' : ''; ?>>Rent</option>
              <option value="Own With Mortgage"<?php echo ($this->Session->read('Application.ResidenceType') == 'Own With Mortgage') ? ' selected="selected"' : ''; ?>>Own with mortgage</option>
              <option value="Own Without Mortgage"<?php echo ($this->Session->read('Application.ResidenceType') == 'Own Without Mortgage') ? ' selected="selected"' : ''; ?>>Own without mortgage</option>
            </select>
            </div>
            <div class="col-sm-2">
              <label for="RentMortgage" class="control-label">Rent/Mortgage:</label>
              <div class="input-group">
                <div id="RentMortgageAddon1" class="input-group-addon">$</div>
                <input type="number" class="form-control" name="RentMortgage" id="RentMortgage" value="<?php echo $this->Session->read('Application.RentMortgage'); ?>"placeholder="Rent/Mortgage" maxlength="5" tabindex="12"
                data-parsley-required="true" 
                data-parsley-type="digits" 
                data-parsley-length="[1,5]"
                data-parsley-group="step1"/>
              </div>
                        </div>
                    </div>
                    <div class="row">

                      <div class="col-sm-4">
            <label for="ResidentSinceDate">Move-in Date:</label>
              
              <select name="ResidentSinceDate" class="form-control" id="ResidentSinceDate" tabindex="13" 
            data-parsley-required="true" 
            data-parsley-group="step1">
              
              <option value="">-Choose Type-</option>
              <option value="2"<?php echo ($this->Session->read('Application.ResidentSinceDate') == '2') ? ' selected="selected"' : ''; ?>>< 3 Months</option>
              <option value="6"<?php echo ($this->Session->read('Application.ResidentSinceDate') == '6') ? ' selected="selected"' : ''; ?>>3 to 6 Months</option>
              <option value="12"<?php echo ($this->Session->read('Application.ResidentSinceDate') == '12') ? ' selected="selected"' : ''; ?>>6 to  12Months</option>
              <option value="24"<?php echo ($this->Session->read('Application.ResidentSinceDate') == '24') ? ' selected="selected"' : ''; ?>>1-2 Years</option>
              <option value="36"<?php echo ($this->Session->read('Application.ResidentSinceDate') == '36') ? ' selected="selected"' : ''; ?>>2-3 Years</option>
              <option value="60"<?php echo ($this->Session->read('Application.ResidentSinceDate') == '60') ? ' selected="selected"' : ''; ?>>3-5 Years</option>
              <option value="72"<?php echo ($this->Session->read('Application.ResidentSinceDate') == '72') ? ' selected="selected"' : ''; ?>>More than 5 Years</option>   

            </select>
                        </div>
                      <div class="col-sm-4">
                        
                        </div>
                      <div class="col-sm-4"></div>
                    </div>
                  </div><!-- tab-pane payday-->
                  
                  <div class="tab-pane tab2" id="tab2">
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="p2_sectionhd">
                              For Your Protection, Verify Your Identity
                              </div>
                          </div>
                      </div>
                    <div class="row">
                      <div class="col-sm-4">
                          <label for="DateOfBirth">Date of Birth</label>
                          <input name="DateOfBirth" id="DateOfBirth" tabindex="1" data-date-format="mm/dd/yyyy" placeholder="Birthdate" type="text" value="<?php echo $this->Session->read('Application.DateOfBirth'); ?>" class="form-control" 
                          data-parsley-required="true" 
                          data-parsley-group="step2"/>
                        </div>
                        <div class="col-sm-4">
            <label for="Ssn">Social Security <a href="https://global.leadstudio.com/whyssn" data-title="Terms and Conditions" data-toggle="lightbox" data-gallery="remoteload"><?php echo $this->Html->image('help.png', array('alt'=>'Help', 'width'=>'10', 'height'=>'10')); ?></a></label>
            <input name="Ssn" type="text" class="form-control" id="Ssn" tabindex="2" size="20" placeholder="SSN" value="<?php echo $this->Session->read('Application.Ssn'); ?>" 
            data-parsley-required="true"
            data-parsley-pattern="/^(\d{3})-(\d{2})-(\d{4})$/" 
            data-parsley-group="step2"/>
                        </div>
                        <div class="col-sm-4">
            <label for="DriversLicenseNumber">Driver's License</label>
            <input name="DriversLicenseNumber" type="text" class="form-control" id="DriversLicenseNumber" tabindex="3" size="20" maxlength="50" value="<?php echo $this->Session->read('Application.DriversLicenseNumber'); ?>" placeholder="License Number" 
            data-parsley-required="true" 
            data-parsley-group="step2"/>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
            <label for="DriversLicenseState">Driver's License State</label>
            <select name="DriversLicenseState" id="DriversLicenseState" class="form-control" tabindex="4" 
            data-parsley-required="true" 
            data-parsley-group="step2">
              <option value="">-Choose State-</option>
              <?php foreach($StateDrop as $key=>$value){
                $selected = '';
                if($this->Session->read('Application.DriversLicenseState') == $key){
                  $selected = ' selected="selected"';
                }
                echo '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
              }
              ?>
              </select>
                        </div>
                      <div class="col-sm-4">
                        <label for="PrimaryPhone">Home Phone</label>
                        <input name="PrimaryPhone" id="PrimaryPhone" type="text" class="form-control" tabindex="5" size="20" value="<?php echo $this->Session->read('Application.PrimaryPhone'); ?>" placeholder="Home Phone" 
                        data-parsley-pattern="/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/"
            data-parsley-group="step2"/>
                        </div>
                  
                      <div class="col-sm-4">
                          <label for="SecondaryPhone">Cell Phone</label>
                          <input name="SecondaryPhone" id="SecondaryPhone" type="text" class="form-control" tabindex="7" size="20" value="<?php echo $this->Session->read('Application.SecondaryPhone'); ?>" placeholder="Cell Phone" 
                          data-parsley-pattern="/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/" 
              data-parsley-group="step2"/>
                        </div>
                      <div class="col-sm-4"></div>
                    </div>
        </div><!-- tab-pane -->
        <div class="tab-pane tab3" id="tab3">
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="p2_sectionhd">
                              Employment Information
                              </div>
                          </div>
                      </div>
                    <div class="row">
                      <div class="col-sm-4">
            <label for="EmployeeType">Employment Type</label>
                          <select name="EmployeeType" class="form-control" id="EmployeeType" tabindex="1" 
                            data-parsley-required="true" 
                            data-parsley-group="step3">
                              <option value="">-Choose-</option>
                                <?php 
                                foreach($EmployeeType as $key=>$value){
                                  $selected = '';
                  if($this->Session->read('Application.EmployeeType') == $key){
                    $selected = ' selected="selected"';
                  }
                  echo '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
                                }
                                ?>
                          </select>
                        </div>
                      <div class="col-sm-4">
            <label for="EmployerName">Employer Name</label>
            <input name="EmployerName" type="text" class="form-control" id="EmployerName" tabindex="2" size="20" maxlength="50" value="<?php echo $this->Session->read('Application.EmployerName');?>" placeholder="Employer Name" 
            data-parsley-required="true" 
            data-parsley-pattern="/^([a-zA-Z0-9\s-'\.\,#_\&\/]{1,50})$/" 
            data-parsley-group="step3"/>
                        </div>
                      <div class="col-sm-4">
            <label for="EmploymentTime">Months At Employer</label>
                            
                            <select name="EmploymentTime" class="form-control" id="EmploymentTime" tabindex="3" 
            data-parsley-required="true" 
            data-parsley-group="step3">
              
            <option value="">-Choose Type-</option>
              <option value="2"<?php echo ($this->Session->read('Application.EmploymentTime') == '2') ? ' selected="selected"' : ''; ?>>< 3 Months</option>
              <option value="6"<?php echo ($this->Session->read('Application.EmploymentTime') == '6') ? ' selected="selected"' : ''; ?>>3 to 6 Months</option>
              <option value="12"<?php echo ($this->Session->read('Application.EmploymentTime') == '12') ? ' selected="selected"' : ''; ?>>6 to  12Months</option>
              <option value="24"<?php echo ($this->Session->read('Application.EmploymentTime') == '24') ? ' selected="selected"' : ''; ?>>1-2 Years</option>
              <option value="36"<?php echo ($this->Session->read('Application.EmploymentTime') == '36') ? ' selected="selected"' : ''; ?>>2-3 Years</option>
              <option value="60"<?php echo ($this->Session->read('Application.EmploymentTime') == '72') ? ' selected="selected"' : ''; ?>>3-5 Years</option>
              <option value="72"<?php echo ($this->Session->read('Application.EmploymentTime') == '72') ? ' selected="selected"' : ''; ?>>More than 5 Years</option>   
            </select>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
                        <label for="WorkPhone">Work Phone</label>
                        <input type="text" placeholder="Work Phone" name="WorkPhone" id="WorkPhone" class="form-control" tabindex="4" value="<?php echo $this->Session->read('Application.WorkPhone');?>" 
                        data-parsley-required="true" 
                        data-parsley-pattern="/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/" 
            data-parsley-group="step3"/>
                        </div>
                      <div class="col-sm-4">
            <label for="EmployerAddress">Employer Address</label>
            <input name="EmployerAddress" type="text" class="form-control" id="EmployerAddress" tabindex="5" maxlength="50" placeholder="Employer Address" value="<?php echo $this->Session->read('Application.EmployerAddress');?>" 
            data-parsley-required="true" 
                        data-parsley-pattern="/^([a-zA-Z0-9\s-\'\.\,\_\#\&\/]{2,50})$/" 
            data-parsley-group="step3"/>
                        </div>
                      <div class="col-sm-4">
            <label for="EmployerZip">Employer Zip Code</label>
            <input name="EmployerZip" type="number" class="form-control" id="EmployerZip" tabindex="6" maxlength="5" placeholder="Employer Zip" value="<?php echo $this->Session->read('Application.EmployerZip');?>" 
            data-parsley-required="true" 
            data-parsley-pattern="/^[0-9]{5}?$/" 
            data-parsley-group="step3"/>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
              <label for="EmployerCity">Employer City</label>
              <input name="EmployerCity" type="text" class="form-control" id="EmployerCity" tabindex="7" maxlength="50" value="<?php echo $this->Session->read('Application.EmployerCity')?>" placeholder="Employer City" 
              data-parsley-required="true" 
              data-parsley-pattern="/^([a-zA-Z\s-\.\']{1,50})$/" 
              data-parsley-group="step3"/>
                        </div>
                      <div class="col-sm-4">
              <label for="MonthlyNetIncome">Monthly Net Income:</label>
              <div class="input-group">
                <div id="MonthlyIncomeAddon1" class="input-group-addon">$</div>
                <input type="number" class="form-control" name="MonthlyNetIncome" tabindex="9" id="MonthlyNetIncome" value="<?php echo $this->Session->read('Application.MonthlyNetIncome'); ?>" data-parsley-required="true"  maxlength="5" tabindex="13"  
                data-parsley-required="true" 
                data-parsley-type="digits" 
                data-parsley-length="[1,5]"
                data-parsley-group="step3"/>
                <div id="MonthlyNetIncomeAddon2" class="input-group-addon">.00</div>
              </div>
                        </div>
                        <div class="col-sm-2">
              <label for="PayFrequency">Pay Frequency</label>
                          <select name='PayFrequency' class="form-control" id='PayFrequency' tabindex="10" 
                          data-parsley-required="true" 
              data-parsley-group="step3">
              <option value=''>-Choose-</option>
              <option value='bi-weekly'<?php echo ($this->Session->read('Application.PayFrequency') == 'bi-weekly') ? ' selected="selected"' : ''; ?>>Every 2 Weeks</option>
              <option value='semi-monthly'<?php echo ($this->Session->read('Application.PayFrequency') == 'semi-monthly') ? ' selected="selected"' : ''; ?>>Twice a Month</option>
              <option value='monthly'<?php echo ($this->Session->read('Application.PayFrequency') == 'monthly') ? ' selected="selected"' : ''; ?>>Monthly</option>
              <option value='weekly'<?php echo ($this->Session->read('Application.PayFrequency') == 'weekly') ? ' selected="selected"' : ''; ?>>Every Week</option>
              </select>
            </div>
            <div class="col-sm-2">
              <label for="Paydate1">Next Paydate</label>
              <input name="Paydate1" type="text" class="form-control" id="Paydate1" value="<?php echo $this->Session->read('Application.Paydate1'); ?>" tabindex="11" 
              data-parsley-required="true" 
              data-parsley-group="step3"/>
            </div>
            <input type="hidden" id="Paydate2" name="Paydate2">
                    </div>
                  </div><!-- tab-pane -->
                  
                  <div class="tab-pane tab4" id="tab4">
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="p2_sectionhd">Tell Us Where To Deposit Your Funds</div>
                          </div>
                      </div>
                  <div class="row">
                      <div class="col-sm-12">
                          <div class="ws_checkimg"></div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
            <label for="BankAccountType">Bank Account Type</label>
            <select name="BankAccountType" class="form-control" id="BankAccountType" tabindex="1"
            data-parsley-required="true"
            data-parsley-group="step5"/>
              <option value="">-Choose Account-</option>
              <option value="checking" <?php echo ($this->Session->read('Application.BankAccountType') == 'checking') ? ' selected="selected"' : ''; ?>>Checking</option>
              <option value="savings" <?php echo ($this->Session->read('Application.BankAccountType') == 'savings') ? ' selected="selected"' : ''; ?>>Savings</option>
            </select> 
                        </div>
                        <div class="col-sm-4">
            <label for="BankRoutingNumber">Routing Number</label>
            <input name="BankRoutingNumber" type="number" class="form-control" id="BankRoutingNumber" tabindex="2" size="20" maxlength="9" placeholder="Routing Number" value="<?php echo $this->Session->read('Application.BankRoutingNumber'); ?>"
            data-parsley-required="true"
            data-parsley-pattern="/^([0-9]{9})$/" 
            data-parsley-group="step5"/>
                        </div>
                        <div class="col-sm-4">
            <label for="BankAccountNumber">Account Number</label>
            <input name="BankAccountNumber" type="number" class="form-control" id="BankAccountNumber" tabindex="3" size="20" maxlength="50" placeholder="Account Number" value="<?php echo $this->Session->read('Application.BankAccountNumber'); ?>"
            data-parsley-required="true"
            data-parsley-pattern="/^[0-9]{4,17}$/" 
            data-parsley-group="step5"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
            <label for="BankName">Bank Name</label>
            <input name="BankName" class="form-control" type="text" id="BankName" tabindex="4" size="20" maxlength="50" readonly style="background-color:lightgrey;" value="<?php echo $this->Session->read('Application.BankName'); ?>"
            data-parsley-required="true"
            data-parsley-group="step5"/>
                        </div>
                      <div class="col-sm-4">
                          <label for="timeAtBank">Time at Bank</label>
                          <select name="BankTime" id="BankTime" class="form-control" tabindex="5"
                          data-parsley-required="true"
              data-parsley-group="step5"/>
                                <option value="">-Choose-</option>
                                <option value="60" <?php echo ($this->Session->read('Application.BankTime') == '60') ? ' selected="selected"' : ''; ?>>5+ Years</option>
                                <option value="48" <?php echo ($this->Session->read('Application.BankTime') == '48') ? ' selected="selected"' : ''; ?>>4+ Years</option>
                                <option value="36" <?php echo ($this->Session->read('Application.BankTime') == '36') ? ' selected="selected"' : ''; ?>>3+ Years</option>
                                <option value="24" <?php echo ($this->Session->read('Application.BankTime') == '24') ? ' selected="selected"' : ''; ?>>2+ Years</option>
                                <option value="12" <?php echo ($this->Session->read('Application.BankTime') == '12') ? ' selected="selected"' : ''; ?>>1+ Years</option>
                                <option value="9" <?php echo ($this->Session->read('Application.BankTime') == '9') ? ' selected="selected"' : ''; ?>>Less than 1 year</option>
                          </select>
                        </div>
                      <div class="col-sm-4">
            <label for="DirectDeposit">Paid By Direct Deposit?</label>
            <select name="DirectDeposit" class="form-control" id="DirectDeposit" tabindex="6" 
            data-parsley-required="true"
            data-parsley-group="step5"> 
            <option value="true" <?php echo ($this->Session->read('Application.DirectDeposit') == 'true') ? ' selected="selected"' : ' selected="selected"'; ?>>Yes</option>
            <option value="false" <?php echo ($this->Session->read('Application.DirectDeposit') == 'false') ? ' selected="selected"' : ''; ?>>No</option>
            </select>
                        </div>
                    </div>

                    <div class="row">
                      <span class="additional_lenders" style="display:none";>
                        <div class="col-sm-4"><?php echo $this->Html->image('additional_lenders.png', array('alt'=>'Include additional lenders', 'class'=>'img-responsive', 'width'=>'330', 'height'=>'67', 'id'=>'add_lenders_img', 'style'=>'margin-top:30px; float:right;')); ?></div>
                        <div class="col-sm-4">
                            <label for="Increase">Connect to all lenders?</label>
                            <select name='swap' class="form-control" id='swap' tabindex="7" 
                            data-parsley-required="true" 
                data-parsley-group="step5">
                <option value='true' selected="selected">Yes, include offers under $1,500</option>
                <option value='false'>No, do NOT include offers under $1,500</option>
                </select>
                          </div>
                        <div class="col-sm-4" style="cursor:pointer;">
                        <a href="http://nkoeg.com/?c=100&s1=NCB" onclick="window.open('http://nkoeg.com/?c=100&s1=NCB', 'newwindow', 
                         'width=400,height=300'); return false;"><?php echo $this->Html->image('no_bank_acct.png', array('alt'=>'No Bank Account', 'class'=>'img-responsive', 'width'=>'130', 'height'=>'30', 'id'=>'no_bank')); ?></a>
                          
                        </div>
                       </span>
                       <span class="additional_lenders">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4 text-center" style="cursor:pointer;">
                       
                        <!-- <?php //echo $this->Html->image('no_bank_acct.png', array('alt'=>'No Bank Account', 'class'=>'', 'width'=>'130', 'height'=>'30', 'id'=>'no_bank_pd')); ?> -->
                          
                         <a href="http://nkoeg.com/?c=100&s1=NCB" onclick="window.open('http://nkoeg.com/?c=100&s1=NCB', 'newwindow', 
                         'width=400,height=300'); return false;">
                         <?php echo $this->Html->image('no_bank_acct.png', array('alt'=>'No Bank Account', 'class'=>'', 'width'=>'130', 'height'=>'30', 'id'=>'no_bank_page')); ?>
                         </a>

                        </div>
                      <div class="col-sm-4"></div>
                    </div>
                    
                    <div class="row" style="margin-top:20px;">
                      <div class="col-sm-12" style="">
                        <div class="ckbox ckbox-success">
                            <input type="checkbox" value="true" id="AgreeConsent" name="AgreeConsent" <?php if($this->Session->read('Application.AgreeConsent')=="true"){echo "checked";} ?> />
                            <label for="AgreeConsent" style="font-weight: normal;">
                            <?php echo ($this->Session->read('Application.CoApplicant') == 'Yes') ? 'We' : 'I';?>
                            understand, agree, and authorize that my information may be sent to lenders on my behalf who may obtain consumer reports and related information about me from one or more consumer reporting agencies, such as TransUnion, Experian, and Equifax. Further, I consent and agree that lender partners may share my personal information with fccrloans, including approval status and funded status.</label>
                        </div>
                      </div>
                      <div class="col-sm-12" >
                      <div class="col-sm-8 col-sm-offset-2" style="text-align: center; border: 1px solid #ccc; ">
                        <label for="AgreePhone">WANT TO RECEIVE A SECURE LINK TO YOUR CURRENT APPLICATION
                        AND ADDITIONAL LOAN OFFERS?
                        <p style="font-weight: normal;">Sign up to receive SMS Alerts from Loan Matching Center with your
                        personal link to apply again,</p>
                       <div class="col-sm-4" style="float: none; margin: 0 auto 1.5em; border:1px solid #CCC;  padding: 10px">
                        <p>Enter Your Primary Number</p>
                        <input name="Phone_TCPA" id="Phone_TCPA" type="text"  tabindex="8" size="20" value="<?php echo $this->Session->read('Application.Phone_TCPA'); ?>" placeholder="Phone Number" data-parsley-pattern="/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/"/></div>
                        <p style="font-weight: normal;">By entering my mobile phone number,I agree by electronic signature to
                        be contacted by Winshiplending, participating lenders, and/or <a id='link' href="https://global.leadstudio.com/thirdparty" data-title="Third Parties" data-toggle="lightbox" data-gallery="remoteload"><b><underline><font color= 'blue'>Third Parties</font></underline></b></a> about financial services and credit related offers by a live agent, artificial or prerecorded voice, and SMS text at the number I provided, dialed manually or by auto dialer, even if I have previously indicated my preference of "do not call" with a government registry (consent to be contacted is not a condition to purchase services; consent can be revoked at any time). Message and data rates may apply. Receive recurring monthly messages.</p></label>
                      </div></div>
                    </div>
                  </div><!-- tab-pane -->
                  <div class="tab-pane tab5" id="tab5">
                      <div class="row">
                          <div class="col-sm-12">
                              <div class="p2_sectionhd">
                              Your application was successfully submitted, please wait while we search our lenders for your offer...
                              </div>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-4">
                        <?php echo $this->Html->image('additional_offers.png', array('alt'=>'Offers For You', 'class'=>'', 'style'=>'margin-top:100px', 'width'=>'330', 'height'=>'67', 'id'=>'add_offers_img')); ?>
                        </div>
                        <div class="col-sm-4">
              <a href="http://nkoeg.com/?c=88&s1=Processing" target='_blank'><?php echo $this->Html->image('vast-plat.jpg', array('id'=>'ad1'))?></a>
                        </div>
                        <div class="col-sm-4"></div>
                      </div>
                      <div class="row" style="text-align:center;">
                        <div class="col-sm-12">
                        <br/>
                          <p>Offers above will open in a new window and will not interfere with your application that is currently processing.</p>
                        </div>
                      </div>
                  </div><!-- tab-pane -->
                  <!-- Co-App Tab -->
                  <div class="tab-pane tab6" id="tab6">
          <div class="row">
                          <div class="col-sm-12">
                              <div class="p2_sectionhd">
                              Co-Application Information - <a href="#tab4" data-toggle="tab" class="link" id="removecoapp">Remove Co-Applicant</a>
                              </div>
                          </div>
                      </div>
                                            
                    <div class="row">
                        <div class="col-sm-4">
            <label for="CoFirstName">First Name:</label>
            <input name="CoFirstName" type="text" class="form-control" id="CoFirstName" tabindex="1" size="15" maxlength="50" value="<?php echo $this->Session->read('Application.CoFirstName'); ?>" placeholder="Co-Applicant First Name" 
            data-parsley-required="true" 
            data-parsley-pattern="/^([a-zA-Z\s-\'\.]{2,50})$/" 
            data-parsley-group="step6"/>
                        </div>
                        <div class="col-sm-4">
            <label for="CoLastName">Last Name:</label>
            <input name="CoLastName" type="text" class="form-control" id="CoLastName" tabindex="2" size="15" maxlength="50"  value="<?php echo $this->Session->read('Application.CoLastName'); ?>" placeholder="Co-Applicant Last Name" 
            data-parsley-required="true" 
            data-parsley-pattern="/^([a-zA-Z\s-\'\.]{2,50})$/" 
            data-parsley-group="step6"/>
                        </div>
                        <div class="col-sm-4">
                        <label for="CoPrimaryPhone">Primary Phone</label>
                        <input name="CoPrimaryPhone" id="CoPrimaryPhone" type="text" class="form-control" tabindex="3" size="20" value="<?php echo $this->Session->read('Application.CoPrimaryPhone'); ?>" placeholder="Co-Applicant Primary Phone" 
                        data-parsley-required="true" 
                        data-parsley-pattern="/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/"
            data-parsley-group="step6"/>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
            <label for="CoSsn">Social Security <a href="https://global.leadstudio.com/whyssn" data-title="Terms and Conditions" data-toggle="lightbox" data-gallery="remoteload"><?php echo $this->Html->image('help.png', array('alt'=>'Help', 'width'=>'10', 'height'=>'10')); ?></a></label>
            <input name="CoSsn" type="text" class="form-control" id="CoSsn" tabindex="4" size="20" placeholder="Co-Applicant SSN" value="<?php echo $this->Session->read('Application.CoSsn'); ?>" 
            data-parsley-required="true"
            data-parsley-pattern="/^(\d{3})-(\d{2})-(\d{4})$/" 
            data-parsley-group="step6"/>
                        </div>
                        <div class="col-sm-4">
                          <label for="CoDateOfBirth">Date of Birth</label>
                          <input name="CoDateOfBirth" id="CoDateOfBirth" data-date-format="mm/dd/yyyy" tabindex="5" placeholder="Co-Applicant Birthdate" type="text" value="<?php echo $this->Session->read('Application.CoDateOfBirth'); ?>" class="form-control" 
                          data-parsley-required="true" 
                          data-parsley-group="step6"/>
                        </div>
                        <div class="col-sm-4">
            <label for="CoEmployeeType">Employment Type</label>
                          <select name="CoEmployeeType" class="form-control" id="CoEmployeeType" tabindex="6" 
                            data-parsley-required="true" 
                            data-parsley-group="step6">
                              <option value="">-Choose-</option>
                                <?php 
                                foreach($EmployeeType as $key=>$value){
                                  $selected = '';
                  
                  if($this->Session->read('Application.CoEmployeeType') == $key){
                    $selected = ' selected="selected"';
                  }
                  echo '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
                                }
                                ?>
                          </select>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
            <label for="CoEmployerName">Employer Name</label>
            <input name="CoEmployerName" type="text" class="form-control" id="CoEmployerName" tabindex="7" size="20" maxlength="50" value="<?php echo $this->Session->read('Application.CoEmployerName');?>" placeholder="Co-Applicant Employer Name" 
            data-parsley-required="true" 
            data-parsley-pattern="/^([a-zA-Z0-9\s-'\.\,#_\&\/]{1,50})$/" 
            data-parsley-group="step6"/>
                        </div>
                      <div class="col-sm-4">
                        <label for="CoWorkPhone">Work Phone</label>
                        <input type="text" placeholder="Co-Applicant Work Phone" name="CoWorkPhone" id="CoWorkPhone" class="form-control" tabindex="8" value="<?php echo $this->Session->read('Application.CoWorkPhone');?>" 
                        data-parsley-required="true" 
                        data-parsley-pattern="/^\s*(?:\+?(\d{1,3}))?[-. (]*(\d{3})[-. )]*(\d{3})[-. ]*(\d{4})(?: *x(\d+))?\s*$/" 
            data-parsley-group="step6"/>
                        </div>
                      <div class="col-sm-4">
            <label for="CoEmploymentTime">Months At Employer</label>
                            
                            <select name="CoEmploymentTime" class="form-control" id="CoEmploymentTime" tabindex="9" 
            data-parsley-required="true" 
            data-parsley-group="step6">
              
            <option value="">-Choose Type-</option>
              <option value="3"<?php echo ($this->Session->read('Application.ResidentSinceDate') == '3') ? ' selected="selected"' : ''; ?>>< 3 Months</option>
              <option value="6"<?php echo ($this->Session->read('Application.ResidentSinceDate') == '6') ? ' selected="selected"' : ''; ?>>3 to 6 Months</option>
              <option value="24"<?php echo ($this->Session->read('Application.ResidentSinceDate') == '24') ? ' selected="selected"' : ''; ?>>1-2 Years</option>
              <option value="36"<?php echo ($this->Session->read('Application.ResidentSinceDate') == '36') ? ' selected="selected"' : ''; ?>>2-3 Years</option>
              <option value="60"<?php echo ($this->Session->read('Application.ResidentSinceDate') == '60') ? ' selected="selected"' : ''; ?>>3-5 Years</option>
              <option value="72"<?php echo ($this->Session->read('Application.ResidentSinceDate') == '72') ? ' selected="selected"' : ''; ?>>More than 5 Years</option>   
            </select>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4">
              <label for="CoMonthlyNetIncome">Monthly Income:</label>
              <div class="input-group">
                <div id="CoMonthlyIncomeAddon1" class="input-group-addon">$</div>
                <input type="number" class="form-control" name="CoMonthlyNetIncome" id="CoMonthlyNetIncome" value="<?php echo $this->Session->read('Application.CoMonthlyNetIncome'); ?>" data-parsley-required="true"  maxlength="5" tabindex="10"  
                data-parsley-required="true" 
                data-parsley-type="digits" 
                data-parsley-length="[1,5]"
                data-parsley-group="step6"/>
                <div id="CoMonthlyNetIncomeAddon2" class="input-group-addon">.00</div>
              </div>
              
            </div>
            <div class="col-sm-4">
                        <label for="CoAppSameAddr">Co-Applicant resides with you?</label>
              <select name="CoAppSameAddr" class="form-control" id="CoAppSameAddr" tabindex="11"
                data-parsley-required="true" 
                data-parsley-group="step6">
                                <option value="">-Select-</option>
                                <option value="No"<?php echo (($this->Session->read('Application.CoAppSameAddr') == 'No') ? ' selected="selected"' : ''); ?>>No</option>
                                <option value="Yes" <?php echo (($this->Session->read('Application.CoAppSameAddr') == 'Yes') ? ' selected="selected"' : ''); ?>>Yes</option>
              </select>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                    <div id="CoAppAddress" style="display:none;" class="row">
            <div class="col-sm-4">
              <label for="CoAddress1">Address:</label>
              <input name="CoAddress1" type="text" class="form-control" id="CoAddress1" tabindex="12" maxlength="50"  value="<?php echo $this->Session->read('Application.CoAddress1'); ?>" placeholder="Co-Applicant Street Address" 
              data-parsley-required="true" 
              data-parsley-pattern="/^([a-zA-Z0-9\s-\'\.\,\_\#\&\/]{2,50})$/" 
              data-parsley-group="step6"/>
                        </div>
                      <div class="col-sm-4">
              <label for="CoAddress2">Address 2 (if needed):</label>
              <input name="CoAddress2" type="text" class="form-control" id="CoAddress2" tabindex="13" maxlength="50"  value="<?php echo $this->Session->read('Application.CoAddress2'); ?>" placeholder="Co-Applicant Street Address" 
              data-parsley-pattern="/^([a-zA-Z0-9\s-\'\.\,\_\#\&\/]{1,50})$/" 
              data-parsley-group="step6"/>
                        </div>
                        <div class="col-sm-2">
              <label for="CoZip">Zip Code:</label>
              <input name="CoZip" type="number" class="form-control" id="CoZip" tabindex="14" maxlength="5" value="<?php echo $this->Session->read('Application.CoZip'); ?>" placeholder="Co-Applicant Zip Code" 
              data-parsley-required="true" 
              data-parsley-pattern="/^[0-9]{5}?$/" 
              data-parsley-group="step6"/>
                        </div>
                        <div class="col-sm-2">
                          <label for="CoCity">City:</label>
              <input name="CoCity" type="text" class="form-control" id="CoCity" tabindex="15" maxlength="50"  value="<?php echo $this->Session->read('Application.CoCity'); ?>" placeholder="Co-Applicant City" 
              data-parsley-required="true" 
              data-parsley-pattern="/^([a-zA-Z\s-\.\']{1,50})$/" 
              data-parsley-group="step6"/>
                        </div>                    
                   </div>
                  </div><!-- tab-pane -->

                  <div class="tab-pane tab7" id="tab7">                
                    <div class="tab-content amount-wrap">
                      <p class='name-text'> <span class='name'></span>, please complete your loan request.</p> 
                      <div class="txt-small">We were not able to connect you with a personal loan lenders at this time</div> 

                      <p class="loan-type">Good News! You may qualify for a short-term loan.</p> 

                      <p>Select a loan amount up to $1000 to continue.</p>

                      <div class="col-md-4"></div>
                        <div class="col-md-4">
                          <div class="col-md-1" ></div>
                            <div class="form-group col-md-12">
                              <select class="form-control" id='LoanAmount' name='LoanAmount' data-parsley-required="true" 
            data-parsley-group="step7">
                                  <option value="">Choose Amount</option>
                                  <?php 
                                  foreach($LoanAmountPayday as $key=>$value){
                                  if($key=='1001'){$key='600';}
                                  echo '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
                                  }
                                  ?>
                              </select>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                <button type="btn" class="btn btn-custom" id="second_loan">Click to Continue</button>
                              </div>
                            </div>   
                          <p><a href="#" id="thanks" style="cursor : pointer;">No Thank You</a></p>  
                        </div><!-- input-form-wrap -->
                      <div class="col-md-4"></div>
                    </div><!-- tab-content -->
                  </div><!-- tab-pane -->
              </div><!-- tab-content -->

              <ul class="list-unstyled wizard">
                  <li class="pull-left previous"><button type="button" class="btn-lg btn-primary btnprev"><span class="glyphicon glyphicon-chevron-left"></span> Previous</button></li>
                  <li class="pull-right next"><button tabindex="20" type="button" class="btn-lg btn-warning btnnext">Next <span class="glyphicon glyphicon-chevron-right"></span></button></li>
              </ul>
              
          </form><!-- #basicWizard -->
        
        </div>
    </div>
</div>
<style type="text/css">                            
    .panel-wizard .tab-content.amount-wrap{
            background: #579301;
            color: #fff;
            padding: 20px;
            text-align: center;
          }                  
          .panel-wizard .tab-content.amount-wrap .btn.btn-custom {                  
              color: #000;
              padding: 5px 10px;
              background: #fbca04;
              border: 1px solid #d1ca12;
              border-radius: 19px;
              height: 37px;
              width: 201px;
              text-transform: uppercase;
              font-size: 15px;
              font-weight: bolder;
          } 

          #tab7 a {
            all: unset;
          } 
          #tab7 * {
            font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
          }
          #tab7 p.name-text{
              font-size: 24px; margin-bottom: 0
          }
          #tab7 .txt-small{
            padding-top: 10px;
            font-size:13px;
          }
          #tab7 .loan-type{
            font-size:20px;
          }
          #tab7 .col-md-1 {
            margin: 1em auto;
          }
          #tab7 select{max-width: 300px; height: 34px;}
          #tab7 #thanks{text-decoration: none; text-transform: uppercase;}
</style>
