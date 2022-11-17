<div class="container" style="background-color: white;">
  <form action="" method="POST" id="thanhtoandonhang" style="padding: 25px;border-radius: 10px"">
  <div class="row">
    <div class="col-md-6 col-sm-6" >
      <div class="footer-support">
        <h5 style="margin-bottom: 20px;text-align: center;font-weight: bold;text-transform: uppercase">Thông tin khách hàng</h5>
        <input type="hidden"  name="user_id" value="<?php if(isset($_SESSION["user_account"]) && !empty($_SESSION["user_account"])): echo $_SESSION["user_account"]["id"];   else: echo "";  endif;?>">
        <div class="form-group">
          <label for="" id="">Họ tên khách hàng :</label>
          <input type="text" name="fullname" class="form-control" placeholder="Nhập họ tên khách hàng"
                 value="<?php if(isset($_SESSION["user_account"]) && !empty($_SESSION["user_account"]['fullname'])){
                   echo $_SESSION['user_account']['fullname'];
                 }  ?>"
          >
          <p class="error"><?php echo isset($this->error['fullname']) ? $this->error['fullname'] : '' ?></p>
        </div>
        <?php if(isset($_SESSION["user_account"])): ?>
          <div class="form-group">
            <label for="" id="">Email nhận thông tin đơn hàng :</label>
            <input type="text" name="email" readonly  class="form-control" placeholder="Nhập Email nhận thông tin về đơn hàng"
                   value="<?php if(isset($_SESSION["user_account"]) && !empty($_SESSION["user_account"]['email'])){
                     echo $_SESSION['user_account']['email'];
                   }  ?>">
            <p class="error"><?php echo isset($this->error['email']) ? $this->error['email'] : '' ?></p>
          </div>
        <?php else: ?>
          <div class="form-group">
            <label for="" id="">Email nhận thông tin đơn hàng :</label>
            <input type="text" name="email"  class="form-control" placeholder="Nhập Email nhận thông tin về đơn hàng"
                   value="<?php if(isset($_SESSION["user_account"]) && !empty($_SESSION["user_account"]['email'])){
                     echo $_SESSION['user_account']['email'];
                   }  ?>">
            <p class="error"><?php echo isset($this->error['email']) ? $this->error['email'] : '' ?></p>
          </div>
        <?php endif; ?>
        <div class="form-group">
          <label for="" id="">Địa chỉ nhận hàng :</label>
          <input type="text" name="address" class="form-control" placeholder="Nhập địa chỉ khách hàng"
                 value="<?php if(isset($_SESSION["user_account"]) && !empty($_SESSION["user_account"]['address'])){
                   echo $_SESSION['user_account']['address'];
                 }  ?>">
          <p class="error"><?php echo isset($this->error['address']) ? $this->error['address'] : '' ?></p>
        </div>
        <div class="form-group">
          <label for="" id="">Số điện thoại người nhận :</label>
          <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại nhận hàng"
                 value="<?php if(isset($_SESSION["user_account"]) && !empty($_SESSION["user_account"]['phone'])){
                   echo $_SESSION['user_account']['phone'];
                 }  ?>">
          <p class="error"><?php echo isset($this->error['phone']) ? $this->error['phone'] : '' ?></p>
        </div>
        <div class="form-group">
          <label for="" id="">Ghi chú(nếu có) :</label>
          <textarea name="note" id="" cols="30" rows="5" placeholder="Ghi chú thêm" class="form-control"></textarea>
        </div>
        <input type="hidden" name="status" value="0">
      </div>
      <br>
      <div class="form-group">
        <label>Chọn phương thức thanh toán :</label> <br />
        <input type="radio" name="method" value="0" id="tructuyen" /> <label for="tructuyen"> Thanh toán trực tuyến</label>  <br />
        <input type="radio" name="method" checked value="1" id="cod" /> <label for="cod"> COD (dựa vào địa chỉ của bạn)</label>  <br />
      </div>
      <input type="submit" name="submit" value="Thanh toán" class="btn btn-outline-danger">
      <a href="gio-hang-cua-ban" class="btn btn-outline-secondary">Về trang giỏ hàng</a>
    </div>
    <div class="col-md-6 col-sm-6 margin20px">
      <h5 style="margin-bottom: 20px;text-align: center;font-weight: bold;text-transform: uppercase"  class="center-align">Thông tin đơn hàng</h5>
      <?php
      $total_cart=0;
      $total_discount=0;
      $total=0;
      $total_product=0;
      if (isset($_SESSION['cart'])):
        ?>
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
      <?php endif; ?>

    </div>
  </div>
  </form>
</div>
<script>
    $("#thanhtoandonhang").validate({
        rules:
            {
                fullname: { required:true },
                address : { required:true },
                phone : {required:true},
                email :{required:true,
                    email: true,

                },
            },
        messages :
            {
                fullname: { required:"Tên người nhận k được để trống" },
                address : { required:"Địa chỉ không được để trống" },
                phone : {required:"Số điện thoại không được để trống" },
                email :{required:"Email không được để trống",
                    email: "Phải có đúng định dạng email",

                },
            }
    });
</script>

<style>
    @media only screen and (max-width: 493px) {
        .margin20px{
            margin-top: 20px;
    }
    }
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