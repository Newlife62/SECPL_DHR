<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        STUDENT DATA UPLOAD
        <small>TWS</small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                            
              <br>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <div class="col-sm-12">
                  <table  class="table table-bordered table-striped table-responsive">
                <thead>
                    <tr>
                        <td colspan="11">
                            <strong>Student Excel Data Formate From SATS (Please Change the Date Formate In Excel , Like DOB , DOA Etc.... And Remove The Unnecessary Rows in Excel Table)</strong>
                        </td>
                    </tr>
<!--                <tr>
                    <th>Sl. No</th>
                  <th>Enrollment No/SATS</th>
                  <th>Student Name</th>
                  <th>Dob</th>
                  <th>Father Name</th>
                  <th>Gender (BOY/GIRL)</th>
                  <th>Social category</th>
                  <th>Religion</th>
                  <th>Disability</th>
                  <th>Aadhar Id</th>
                  <th>Class</th>
                </tr>-->
                </thead>
                  </table>
                </div>
                <div class="col-sm-4"></div>
                <div class="col-sm-4">
                <form name="import" method="post" enctype="multipart/form-data">
                    <input type="file" class="form-control" name="file" value="select"/><br />
                    <input type="submit" class="btn btn-primary btn-sm" name="submit" value="Upload Data" />
                </form>
                                        <?php
                if (isset($_POST["submit"])) {
                    // $l = $this->db->select('*')->from('loan_details')->get();
                    // foreach($l->result_array() as $r){
                    //     $where = array(
                    //         'date'=>$r['issued_date'],
                    //         'time'=>$r['issued_time'],
                    //         'teacher_id'=>$r['teacher_id'],
                    //         'pay_for'=>'LOAN'
                    //         );
                    //     $this->db->where($where)->set('loan_ref_id',$r['id'])->update('loan_ledger');
                    // }
                }
                    ?>
                    </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>