<?php
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0){
	//Request hash
	$contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';
	if(strcasecmp($contentType, 'application/json') == 0){
		$data = json_decode(file_get_contents('php://input'));
		$hash=hash('sha512', $data->key.'|'.$data->txnid.'|'.$data->amount.'|'.$data->pinfo.'|'.$data->fname.'|'.$data->email.'|||||'.$data->udf5.'||||||'.$data->salt);
		$json=array();
		$json['success'] = $hash;
    	echo json_encode($json);

	}
	exit(0);
}

function getCallbackUrl()
{
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . 'response.php';
}

?>
<?php
include_once("header.php");

$Products = array();

array_push($Products,array(
	'product_id' =>'1',
	'product_name' =>'V-neck T-shirt',
	'img' =>'https://www.beyoung.in/media/catalog/product/cache/c687aa7517cf01e65c009f6943c2b1e9/m/s/ms_dhoni_black_plus_size_men_model.jpg',
	'size_s' =>'0',
	'size_m' =>'0',
	'size_l' =>'0',
	'size_xl' =>'0',
	'size_xxl' =>'0',
	'size_xxxl' =>'0',
	'size_xxxl' =>'0',
	'price_peice' =>'500',
	'price_base' =>'0',
	'price_gst' =>'0'
),
array(
	'product_id' =>'1',
	'product_name' =>'Round-neck T-shirt',
	'img' =>'https://www.beyoung.in/media/catalog/product/cache/c687aa7517cf01e65c009f6943c2b1e9/m/s/ms_dhoni_black_plus_size_men_model.jpg',
	'size_s' =>'0',
	'size_m' =>'0',
	'size_l' =>'0',
	'size_xl' =>'0',
	'size_xxl' =>'0',
	'size_xxxl' =>'0',
	'size_xxxl' =>'0',
	'price_peice' =>'500',
	'price_base' =>'0',
	'price_gst' =>'0'
));
$location = file_get_contents('https://ipinfo.io/json');
$location = json_decode($location);
?>

<style type="text/css">
	.main {
		margin-left:30px;
		font-family:Verdana, Geneva, sans-serif, serif;
	}
	.text {
		float:left;
		width:180px;
	}
	.dv {
		margin-bottom:5px;
    }
    #boltFrame{
        z-index:99999999!important;
    }
</style>

<!-- BOLT Sandbox/test //-->
<!-- <script id="bolt" src="https://sboxcheckout-static.citruspay.com/bolt/run/bolt.min.js" bolt-
color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script> -->
<!-- BOLT Production/Live //-->
<script id="bolt" src="https://checkout-static.citruspay.com/bolt/run/bolt.min.js" bolt-color="e34524" bolt-logo="http://boltiswatching.com/wp-content/uploads/2015/09/Bolt-Logo-e14421724859591.png"></script >
<section>
    <div class="container">
        <h2 class="text-center">Checkout</h2>
        <h4>Order Sumarry</h4>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                <th rowspan="2">Selected Products</th>
                <th colspan="6">Sizes</th>
                <th rowspan="2">No. of Pieces</th>
                <th rowspan="2">Price Per Pieces(in Rs.)</th>
                <th rowspan="2">Basic Price</th>
                <th rowspan="2">GST(5%)</th>
                <th rowspan="2">Gross Total</th>
                </tr>
                <tr>
                <th>S</th>
                <th>M</th>
                <th>L</th>
                <th>XL</th>
                <th>XXL</th>
                <th>XXXL</th>
                </tr>
            </thead>
            <tbody>
							<?php foreach ($Products as $row){ ?>
    					<tr class="iterator-row">
                <th scope="row"><img src="<?php echo $row['img']; ?>" alt="Boy in a jacket" width="50" height="50"> </th>
                <td><input type="number" min="0" value="0" class="form-control prod-size" name="size_s"/></td>
								<td><input type="number" min="0" value="0" class="form-control prod-size" name="size_m"/></td>
								<td><input type="number" min="0" value="0" class="form-control prod-size" name="size_l"/></td>
								<td><input type="number" min="0" value="0" class="form-control prod-size" name="size_xl"/></td>
								<td><input type="number" min="0" value="0" class="form-control prod-size" name="size_xxl"/></td>
								<td><input type="number" min="0" value="0" class="form-control prod-size" name="size_xxxl"/></td>
							  <td class="num-peices">0</td>
                <td class="price-peice"><?php echo $row['price_peice']; ?></td>
                <td class="price-basic">00</td>
                <td class="price-gst">00</td>
                <td class="gross-price">00</td>
                </tr>
								<?php } ?>
                <tr>
                <th rowspan="2">Delivery</th>
                <td colspan="9"><input type="radio" id="delivery-mode" name="delivery_mode" value="Standard" checked> <label for="delivery-mode">Standard Delivery(Delivery in 7-10 days)</label></td>
                <td>0.00</td>
                <td></td>
                </tr>
                <tr>
                <td colspan="9"><input type="radio" id="delivery-mode1" name="delivery_mode" value="Express"> <label for="delivery-mode1">Express Delivery(Delivery in 2-3 days)</label></td>
                <td>0.00</td>
                <td>0.00</td>
                </tr>
                <tr>
                <th></th>
                <th colspan="9" class="text-right">Amount to be paid:</th>
                <td>0.00</td>
                <td class="amt-paid">0.00</td>
                </tr>

            </tbody>
        </table>
        <!-- Billing Form -->
        <div class="">
            <div class="form-check my-3">
                <input class="form-check-input" type="checkbox" value="" id="stbilling-add">
                <label class="form-check-label" for="stbilling-add">
                    Ship to a Billing Address?
                </label>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro, alias tempora enim nam veritatis sit mollitia ullam quibusdam aliquid ea numquam officia quia nobis sint eum consequatur, maiores maxime voluptas.</p> -->
										<form action="#" id="payment_form">
									    <input type="hidden" id="udf5" name="udf5" value="BOLT_KIT_PHP7" />
									    <input type="hidden" id="surl" name="surl" value="<?php echo getCallbackUrl(); ?>" />
									    <div class="dv">
									    <!-- <span class="text"><label>Merchant Key:</label></span> -->
									    <span><input type="hidden" id="key" name="key" placeholder="Merchant Key" value="ZugZGIJB" /></span>
									    </div>

									    <div class="dv">
									    <span><input type="hidden" id="salt" name="salt" placeholder="Merchant Salt" value="ys6i88jP5I" /></span>
									    </div>

									    <div class="dv">
									    <span><input type="hidden" id="txnid" name="txnid" placeholder="Transaction ID" value="<?php echo  "Txn" . rand(10000,99999999)?>" /></span>
									    </div>

									    <div class="dv">
									    <span><input type="hidden" id="amount" name="amount" placeholder="Amount" value="1.00" /></span>
									    </div>

									    <div class="dv">
									    <span><input type="hidden" id="pinfo" name="pinfo" placeholder="Product Info" value="P01,P02" /></span>
									    </div>

									    <div class="dv">
									    <span><input type="hidden" id="mobile" name="mobile" placeholder="Mobile/Cell Number" value="9503692037" /></span>
									    </div>

									    <div class="dv">
									    <span><input type="hidden" id="hash" name="hash" placeholder="Hash" value="" /></span>
									    </div>

									  <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="fname">First Name <span class="text-danger">*</span></label>
																<input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" value="" />
													  </div>
                            <div class="form-group col-md-6">
                                <label for="lname">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="lname" name="lname" autocomplete="off">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="cname">GST No</label>
                                <input type="text" class="form-control" id="gstname" name="cname" autocomplete="off">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="cname">Company Name </label>
                                <input type="text" class="form-control" id="cname" name="cname" autocomplete="off">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputState">Country<span class="text-danger">*</span></label>
                                <select id="bcountry" class="form-control">
                                    <option>India</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="bs-add1">Street Address<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="bs-add1" name="bs_address1" placeholder="House no. and street name" autocomplete="off">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" class="form-control" id="bs-add2" name="bs_address2" placeholder="Appartment" autocomplete="off">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="bcity">Town/City<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="bcity" value="<?php echo $location->city; ?>" name="bcity" autocomplete="off">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="bstate">State<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="bstate" name="bstate" value="<?php echo $location->region; ?>" autocomplete="off">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="bs-add1">Pincode/Zip<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="Pincode" name="Pincode" value="<?php echo $location->postal; ?>" autocomplete="off">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="bemail">Email Address<span class="text-danger">*</span></label>
																<input type="email" class="form-control" id="email" name="email" placeholder="Email ID" value="vishalkawde9418@gmail.com" autocomplete="off"/>
                            </div>
                            <div class="form-check my-3">
                                <input class="form-check-input" type="checkbox" value="" id="stbilling-add">
                                <label class="form-check-label" for="stbilling-add">
                                    Ship to a Billing Address?
                                </label>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="order-notes" class="font-weight-bold">Order Notes</label>
                                <textarea class="form-control bg-light" id="order-notes" rows="3" name="order_notes" placeholder="Note about your order,e.g. special notes for delivery."></textarea>
                            </div>
                        </div>
                </div>
                <div class="offset-md-1 col-md-5">
                    <div class="border p-4">
                        <h6 class="heading-bborder mb-5">Your Order</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Product</h6>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-right">Total</h6>
                            </div>
                        </div>
                        <hr class="mt-0">
													<?php foreach ($Products as $row){ ?>
                        <div class="row">
                            <div class="col-md-6">
                                <h6><?php echo $row['product_name']; ?> X <span class="prod-quantity">1</span></h6>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-right"><span class="prod-price">0.00</span></h6>
                            </div>
                        </div>
											<?php } ?>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Sub Total</h6>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-right sub-total">0.00</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Shipping</h6>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-right shipping-costs">0.00</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Total</h6>
                            </div>
                            <div class="col-md-8">
                                <h6 class="text-right final-total">0.00</h6>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12 mx-auto pt-1">
                            <button type="submit" onclick="launchBOLT(); return false;" class="btn btn-secondary btn-block border-0">PLACE ORDER</button>
                        </div>
                    </div>

											</form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include_once("footer.php");
?>
<script type="text/javascript">
$("input").keyup(function(e) {
	$.ajax({
					url: 'checkout.php',
					type: 'post',
					data: JSON.stringify({
						key: $('#key').val(),
			salt: $('#salt').val(),
			txnid: $('#txnid').val(),
			amount: $('#amount').val(),
				pinfo: $('#pinfo').val(),
						fname: $('#fname').val(),
			email: $('#email').val(),
			mobile: $('#mobile').val(),
			udf5: $('#udf5').val()
					}),
			contentType: "application/json",
					dataType: 'json',
					success: function(json) {
						if (json['error']) {
			 $('#alertinfo').html('<i class="fa fa-info-circle"></i>'+json['error']);
						}
			else if (json['success']) {
				$('#hash').val(json['success']);
						}
					}
				});
});
$.ajax({
				url: 'checkout.php',
				type: 'post',
				data: JSON.stringify({
					key: $('#key').val(),
		salt: $('#salt').val(),
		txnid: $('#txnid').val(),
		amount: $('#amount').val(),
			pinfo: $('#pinfo').val(),
					fname: $('#fname').val(),
		email: $('#email').val(),
		mobile: $('#mobile').val(),
		udf5: $('#udf5').val()
				}),
		contentType: "application/json",
				dataType: 'json',
				success: function(json) {
					if (json['error']) {
		 $('#alertinfo').html('<i class="fa fa-info-circle"></i>'+json['error']);
					}
		else if (json['success']) {
			$('#hash').val(json['success']);
					}
				}
			});
function launchBOLT()
{
	bolt.launch({
	key: $('#key').val(),
	txnid: $('#txnid').val(),
	hash: $('#hash').val(),
	amount: $('#amount').val(),
	firstname: $('#fname').val(),
	email: $('#email').val(),
	phone: $('#mobile').val(),
	productinfo: $('#pinfo').val(),
	udf5: $('#udf5').val(),
	surl : $('#surl').val(),
	furl: $('#surl').val(),
	mode: 'dropout'
},{ responseHandler: function(BOLT){
	console.log( BOLT.response.txnStatus );
	if(BOLT.response.txnStatus != 'CANCEL')
	{
		//Salt is passd here for demo purpose only. For practical use keep salt at server side only.
		var fr = '<form action=\"'+$('#surl').val()+'\" method=\"post\">' +
		'<input type=\"hidden\" name=\"key\" value=\"'+BOLT.response.key+'\" />' +
		'<input type=\"hidden\" name=\"salt\" value=\"'+$('#salt').val()+'\" />' +
		'<input type=\"hidden\" name=\"txnid\" value=\"'+BOLT.response.txnid+'\" />' +
		'<input type=\"hidden\" name=\"amount\" value=\"'+BOLT.response.amount+'\" />' +
		'<input type=\"hidden\" name=\"productinfo\" value=\"'+BOLT.response.productinfo+'\" />' +
		'<input type=\"hidden\" name=\"firstname\" value=\"'+BOLT.response.firstname+'\" />' +
		'<input type=\"hidden\" name=\"email\" value=\"'+BOLT.response.email+'\" />' +
		'<input type=\"hidden\" name=\"udf5\" value=\"'+BOLT.response.udf5+'\" />' +
		'<input type=\"hidden\" name=\"mihpayid\" value=\"'+BOLT.response.mihpayid+'\" />' +
		'<input type=\"hidden\" name=\"status\" value=\"'+BOLT.response.status+'\" />' +
		'<input type=\"hidden\" name=\"hash\" value=\"'+BOLT.response.hash+'\" />' +
		'</form>';
		var form = jQuery(fr);
		jQuery('body').append(form);
		form.submit();
	}
},
	catchException: function(BOLT){
 		alert( BOLT.message );
	}
});
}
$(".prod-size").change(function(e){
	var Quantity= 0;

	$('.prod-size').each(function(){
		Quantity =parseInt(Quantity)+ parseInt($(this).val());
			//alert($(this).val());
	});
	$(".num-peices:eq(0)").text(Quantity);
		$(".price-basic:eq(0)").text(Quantity*500);
			$(".price-gst:eq(0)").text(Quantity*500*0.05);
				$(".gross-price:eq(0)").text(Quantity*500*1.05);
				$(".amt-paid:eq(0)").text(Quantity*500*1.05);
				$(".sub-total:eq(0)").text(Quantity*500*1.05);
					$(".prod-price:eq(0)").text(Quantity*500*1.05);
						$(".final-total:eq(0)").text(Quantity*500*1.05);
					$('#amount').val(Quantity*500*1.05);
});
</script>
