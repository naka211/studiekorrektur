<?php
defined('_JEXEC') or die('Restricted access');
?>

<html>
    <head>
	<style>
        body {font-family: arial; font-size: 14px;}
        .wrapper {width: 800px; margin: 0 auto;}
        table {text-align: left; width: 100%; border-bottom: none;}
        table thead {background-color: #323232; color: #fff;}
        table thead th {padding: 10px 5px; text-align: left;}
        table tr td {padding: 10px 5px; border-bottom: 1px solid #e5e5e5;}
    </style>

    </head>

    <body>
	<div class="wrapper">
        <table cellpadding="0" cellspacing="0">
            <tr>
                <td style="border-bottom: none;">
                    <!--<h2>Tak for din ordre </h2>-->
					<p>Kære <?php echo $this->orderDetails["details"]["BT"]->first_name." ".$this->orderDetails["details"]["BT"]->last_name;?>,</p>
                    <p>Tak for din ordre!<br><br>
                    Vi har modtaget din bestilling og den uploadede fil.<br><br>
                    Dit ordrenr. er <?php echo $this->orderDetails["details"]["BT"]->order_number;?><!-- - du modtager også denne ordrebekræftelse på mail-->.</p>
                    <p>Sprog: <?php echo $this->orderDetails["details"]["BT"]->language;?></p>
                    <p>Leveringstidspunkt: <?php echo $this->orderDetails["details"]["BT"]->delivery_date;?></p>   
					<p>Kommentar: <?php echo $this->orderDetails["details"]["BT"]->comment;?></p> 
                </td>
            </tr>
        </table>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th>Produkt</th>
                    <th class="text-center">Antal normalsider</th>
                    <th class="text-center">Stk. Pris</th>
                    <th class="text-right">Pris</th>
                </tr>
            </thead>
            <tbody>
				<?php foreach($this->orderDetails["items"] as $item){?>
                <tr>
                    <td><?php echo $item->order_item_name;?></td>
					<td class="text-center"><?php if($item->virtuemart_product_id != 5) echo $item->product_quantity;?></td>
					<td class="text-center"><?php if($item->virtuemart_product_id != 5) echo number_format($item->product_final_price,2,',','.').' DKK'; ?></td>
					<td class="text-right"><?php echo number_format($item->product_subtotal_with_tax,2,',','.').' DKK'; ?></td>
                </tr>
				<?php }?>
				<?php if($this->orderDetails["details"]["BT"]->coupon_code){?>
                <tr>
                    <td style="border-bottom: none;" colspan="3"><strong>Rabat</strong></td>
                    <td style="border-bottom: none;" class="text-right"><strong><?php echo $this->orderDetails["details"]["BT"]->coupon_discount;?> DKK</strong></td>
                </tr>
				<?php }?>
                <tr>
                    <td colspan="3"><strong>Pris i alt (inkl. moms):</strong></td>
                    <td class="text-right"><strong><?php echo number_format($this->orderDetails["details"]["BT"]->order_total,2,',','.').' DKK'; ?></strong></td>
                </tr>
                <tr>
                    <td  style="border-bottom: none;" colspan="4">
                        <p>Du er velkommen til at kontakte os på info@studiekorrektur.dk eller +45 3029 6044, hvis du skulle have spørgsmål.<br><br>
                        Du ønskes en god dag!</p>
                        <p>De bedste hilsener,<br>
                        Teamet bag Studiekorrektur.dk<br><br>
						<img src="<?php echo JURI::base();?>templates/studie/img/logo.png" /><br><br>
						Tlf.: +45 3029 6044<br>
						Website: <a href="www.studiekorrektur.dk">www.studiekorrektur.dk</a></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    </body>
</html>