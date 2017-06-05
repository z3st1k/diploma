<div class="container">
    <div class="row">
        <div class="col-md-6 col-center">
            <div class="panel panel-default credit-card-box">
                <div class="panel-heading display-table" >
                    <div class="row display-tr" >
                        <h3 class="panel-title display-td" >Payment Details</h3>
                        <div class="display-td" >
                            <img class="img-responsive pull-right" src="<?php echo $this->webroot;?>img/privatbank-corporate-logo-latina.png">
                        </div>
                    </div>
                </div>
                <div class="panel-body noscroll">
                    <form method="POST" action="https://api.privatbank.ua/p24api/ishop">
                        <input type="hidden" name="ccy" value="UAH" />
                        <input type="hidden" name="merchant" value="127969" />
                        <input type="hidden" name="order" value="" />
                        <input type="hidden" name="ext_details" value="Details" />
                        <input type="hidden" name="pay_way" value="privat24" />
                        <input type="hidden" name="return_url" value="http://z3st1k.zzz.com.ua/finances/callback" />
                        <input type="hidden" name="server_url" value="http://z3st1k.zzz.com.ua/finances/notify" />
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardNumber">Amount</label>
                                    <div class="input-group">
                                        <input
                                            type="tel"
                                            class="form-control"
                                            name="amt"
                                            placeholder="Enter amount"
                                            required autofocus
                                        />
                                        <span class="input-group-addon"><i class="fa fa-money"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label for="cardNumber">Description</label>
                                    <textarea class="form-control" name="details"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-success" type="submit">
                                    <i class="fa fa-dollar"></i>
                                    Make Deposit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
