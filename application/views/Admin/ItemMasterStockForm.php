
    <div class="container mt-5">
        <h1 class="text-center mb-4">Item Master Stock Form</h1>
        <form>
            <!-- Row 1 -->
            <div class="row mb-3">
                <div class="col-sm-4">
                    <label for="item_name" class="form-label">Item Name</label>
                    <input type="text" class="form-control" id="item_name" name="item_name">
                </div>
                <div class="col-sm-8">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>
            </div>

            <!-- Row 2 -->
            <div class="row mb-3">
                <div class="col-sm-4">
                    <label for="group" class="form-label">Group</label>
                    <input type="text" class="form-control" id="group" name="group">
                </div>
                <div class="col-sm-4">
                    <label for="uom" class="form-label">Unit of Measure (UOM)</label>
                    <input type="text" class="form-control" id="uom" name="uom">
                </div>
                <div class="col-sm-4">
                    <label for="appl_date" class="form-label">Application Date</label>
                    <input type="text" class="form-control" id="appl_date" name="appl_date">
                </div>
            </div>

            <!-- Row 3 -->
            <div class="row mb-3">
                <div class="col-sm-4">
                    <label for="std_cost" class="form-label">Standard Cost</label>
                    <input type="text" class="form-control" id="std_cost" name="std_cost">
                </div>
                <div class="col-sm-4">
                    <label for="std_price" class="form-label">Standard Price</label>
                    <input type="text" class="form-control" id="std_price" name="std_price">
                </div>
                <div class="col-sm-4">
                    <label for="i_p_vat" class="form-label">Input VAT</label>
                    <input type="text" class="form-control" id="i_p_vat" name="i_p_vat">
                </div>
            </div>

            <!-- Additional rows for other fields -->
            <div class="row mb-3">
                <div class="col-sm-4">
                    <label for="o_p_vat" class="form-label">Output VAT</label>
                    <input type="text" class="form-control" id="o_p_vat" name="o_p_vat">
                </div>
                <div class="col-sm-4">
                    <label for="tariff" class="form-label">Tariff</label>
                    <input type="text" class="form-control" id="tariff" name="tariff">
                </div>
                <div class="col-sm-4">
                    <label for="partno" class="form-label">Part Number</label>
                    <input type="text" class="form-control" id="partno" name="partno">
                </div>
            </div>

            <!-- Continue for all remaining fields -->

            <div class="row mb-3">
                <div class="col-sm-6">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                </div>
                <div class="col-sm-6">
                    <label for="jwm_bom" class="form-label">JWM BOM</label>
                    <input type="text" class="form-control" id="jwm_bom" name="jwm_bom">
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>

