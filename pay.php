<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<style> 
	.paypal-box {
		width: 100%;
	    padding: .24em 0;
	    line-height: 1.5rem;
	    display: inline-flex;
	    background: #0c1115;
	    position: fixed;
	    bottom: 0;
	    z-index: 800;
	    user-select: none;
	}
	.paypal-box .row {
		width: 80%;
		margin: 0 auto;
		justify-content: space-between;
    	display: flex;
    	align-items: center;
	}
	.paypal-box .row span {
		color: silver;
	    font-size: 1.5rem;
	    font-family: sans-serif;
	    font-style: italic;
	    font-weight: 100;
	}
	.btn-pay {
	    padding: .2rem 1rem;
	    text-decoration: none; 	    
	    background: #176cb5;
	    cursor: pointer;
	    border-radius: 2px;
	    font-size: 17px;
	    font-family: sans-serif;
	    vertical-align: middle;
	    text-align: center;
	    width: auto;
	    -webkit-transition: all .4s;
	    -o-transition: all .4s;
	    transition: all .4s;
	    color: white;
	    border:2px solid transparent;
	}
	.btn-pay:hover {
	    background:#155d9a;
	    
	}

	</style>


</head>
<body>
	<div class="paypal-box">
	    <div class="row">	    	
			<span> Comprar carrito de compras $ 20.00 </span>
			<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=JL9DBH36632D2" class="btn-pay"><i class="fa fa-paypal"></i> Comprar ahora</a>        
	    </div>
	</div>

	
</body>
</html>