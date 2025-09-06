<div class="app-content">
	<div class="app-title">
        <div>
          <h1><i class="fa fa-book"></i>Cash Book</h1>
          <p></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="#">Cash Book</a></li>
        </ul>
    </div>
    <style type="text/css">
    	.headerclass{
    		border:solid black 1px;
    		text-align: center;
    	}
    </style>
	<div class="tile">
		<div class="tile-body">
			<div class="row">
                        <div class="col-sm-3" >
                            <label>From</label>
                            <input type="date" name="from" id="from" class="form-control">
                        </div>
                        <div class="col-sm-3" >
                            <label>To</label>
                            <input type="date" name="to" id="to" class="form-control">
                        </div>
                        <div class="col-sm-3" >
                            <label>Bank</label>
                            <select name="bank_id" id="bank_id" class="form-control">
                                <option value="">Select The Bank</option>
                                <?php 
                                if($banks->num_rows()>0) {
                                        foreach($banks->result_array() as $bank){ ?>
                                            <option value="<?=$bank['id']?>"><?=$bank['bank_name']?></option>
                                <?php   }
                                }
                                ?>
                            </select>
                        </div>
                        
            </div>
        </div>
	</div>
	
    <div  id="cashbook"></div>
	</div>