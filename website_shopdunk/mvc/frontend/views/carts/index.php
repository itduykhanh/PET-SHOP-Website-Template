<?php
$total_cart=0;
$total_discount=0;
$total=0;
$total_product=0;
?>
<!---->
<div class="container" style="margin-top: 10px;margin-bottom: 10px;">
    <h1>Giỏ Hàng</h1>
  <?php if(!empty($_SESSION["cart"])): ?>
    <div class="row">
      <div class="col-sm-12">
        <div class="template-cart">
          <form action="" method="post" id="shoppingCart">
              <table>
                  <thead>
                  <tr>
                      <th scope="col"></th>
                      <th scope="col">Sản phẩm</th>
                      <th scope="col">Giá</th>
                      <th scope="col">Số lượng</th>
                      <th scope="col">Khuyến mãi</th>
                      <th scope="col">Tạm tính</th>
                      <th scope="col">&nbsp;</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach ($_SESSION["cart"] as $product_id => $cart):
                  $slug=Helper::getSlug($cart["name"]);
                  $url_detail="chi-tiet-san-pham/$slug/$product_id";
                  ?>
                  <tr>
                      <td data-label="">
                          <a href="<?php echo $url_detail; ?>">
                              <img style="width: 110px;height: 100%" src="assets/uploads/products/<?php echo $cart["avatar"]; ?>"
                                   class="img-responsive" />
                          </a>
                      </td>
                      <td data-label="Sản phẩm"><a style="text-align: right" href="<?php echo $url_detail; ?>"> <?php echo $cart["name"]; ?></a></td>
                      <td data-label="Giá">  <?php echo number_format($cart["price"]); ?> VND</td>
                      <td data-label="Số lượng">
                          <input type="number" style="width: 25%;text-align: center;" class="form-contro " name="<?php echo $product_id; ?>" value="<?php echo $cart["quality"]; ?>" min="1" >
                      </td>
                      <td data-label="Khuyến mãi"><?php echo isset($cart["discount"])? $cart["discount"] : 0; ?> %</td>
                      <td data-label="Tạm tính">
                          <?php
                          $total_item_discount=($cart["price"] * ($cart["discount"]/100)) * $cart["quality"] ;
                          $total_item=($cart["price"] * $cart["quality"]);
                          $total_product=$total_item-$total_item_discount;
                          echo number_format($total_product);
                          $total_cart += $total_item;
                          $total_discount += $total_item_discount;
                          $total +=$total_product;
                          ?>
                          VND</td>
                      <td data-label="&nbsp;">
                          <a class="btn btn-default" href="xoa-san-pham/<?php echo $product_id; ?>"  onclick="return window.confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng ?');" data-id="2479395">
                              <i style="font-size: 25px" class="fa fa-times-circle"></em></i>
                          </a>
                      </td>
                  </tr>
                  <?php endforeach; ?>
                  </tbody>
              </table>
          </form>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12" style="text-align: right;font-size: 20px;">
        <div class="total-col">
          <div class="label__total">Thành tiền :  <?php echo number_format($total_cart); ?> VND</div>
          <div class="label__sale">Giảm giá : <?php echo number_format($total_discount); ?> VND</div>
          <div class="label__cart">Tổng số tiền thanh toán : <span><?php echo number_format($total); ?> VND</span></div>
          <div style="margin-top: 10px;">
            <a class="btn btn-success" href="thanh-toan"> Thanh toán giỏ hàng</a>
          </div>

        </div>
      </div>
    </div>
  <?php else: ?>
    <h3 style="text-align: center">Giỏ hàng của bạn trống</h3>
  <?php endif;?>
</div>
<!-- end main -->
<style>
    table {
        border: 1px solid #ccc;
        border-collapse: collapse;
        margin: 0;
        padding: 0;
        width: 100%;
        table-layout: fixed;
    }

    table caption {
        font-size: 1.5em;
        margin: .5em 0 .75em;
    }

    table tr {
        background-color: #f8f8f8;
        border: 1px solid #ddd;
        padding: .35em;
    }

    table th,
    table td {
        padding: .625em;
        text-align: center;
    }

    table th {
        font-size: .85em;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    @media screen and (max-width: 600px) {
        table {
            border: 0;
        }

        table caption {
            font-size: 1.3em;
        }

        table thead {
            border: none;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }

        table tr {
            border-bottom: 3px solid #ddd;
            display: block;
            margin-bottom: .625em;
        }

        table td {
            border-bottom: 1px solid #ddd;
            display: block;
            font-size: .8em;
            text-align: right;
        }

        table td::before {
            /*
            * aria-label has no advantage, it won't be read inside a table
            content: attr(aria-label);
            */
            content: attr(data-label);
            float: left;
            font-weight: bold;
            text-transform: uppercase;
        }

        table td:last-child {
            border-bottom: 0;
        }
    }

</style>