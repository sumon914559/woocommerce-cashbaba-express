<?php 

 //echo $userId = get_current_user_id();	


 //echo $userId = get_current_user_id();	
 
//global $wp_session;

								
					

echo  $logInUserId = $wp_session['user_id'];

$receivedData = $_POST ;
/*echo "<pre>";

print_r($_POST);

echo "</pre>";*/

?>

<span><a href="http://localhost/dhakafashion/">Go To Shop<a></span>

<?php 
echo "<br/>";

echo get_site_url(); 

 
?>
<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">
   <tbody>
      <tr>
         <td align="center" valign="top">
            <div id="m_858503997237132604template_header_image">
            </div>
            <table border="0" cellpadding="0" cellspacing="0" width="600" id="m_858503997237132604template_container" style="background-color:#fdfdfd;border:1px solid #dcdcdc;border-radius:3px!important">
               <tbody>
                  <tr>
                     <td align="center" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" width="600" id="m_858503997237132604template_header" style="background-color:#557da1;border-radius:3px 3px 0 0!important;color:#ffffff;border-bottom:0;font-weight:bold;line-height:100%;vertical-align:middle;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif">
                           <tbody>
                              <tr>
                                 <td>
                                    <h1 style="color:#ffffff;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:30px;font-weight:300;line-height:150%;margin:0;padding:36px 48px;text-align:left">New order
                                       Details
                                    </h1>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td align="center" valign="top">
                        <table border="0" cellpadding="0" cellspacing="0" width="600" id="m_858503997237132604template_body">
                           <tbody>
                              <tr>
                                 <td valign="top" id="m_858503997237132604body_content" style="background-color:#fdfdfd">
                                    <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                       <tbody>
                                          <tr>
                                             <td valign="top" style="padding:48px">
                                                <div id="m_858503997237132604body_content_inner" style="color:#737373;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:14px;line-height:150%;text-align:left">
                                                   <p style="margin:0 0 16px">Congratulation! 
												   <?php echo $receivedData['CustomerName']; ?>. The order is as
                                                      follows:
                                                   </p>
                                                   <h2 style="color:#557da1;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:16px 0 8px;text-align:left">
                                                      <a href="http://dhakafashion.com/wp-admin/post.php?post=6083&amp;action=edit" style="color:#557da1;font-weight:normal;text-decoration:underline" target="_blank" data-saferedirecturl="https://www.google.com/url?hl=en&amp;q=http://dhakafashion.com/wp-admin/post.php?post%3D6083%26action%3Dedit&amp;source=gmail&amp;ust=1518150419392000&amp;usg=AFQjCNEQgzVF-FI1VCo3ABx1BAiznJ7ZXA">Order 
													  #<?php echo $receivedData['OrderId']; ?>
                                                      </a> (<time datetime="2018-02-07T10:08:40+00:00">
													  <?php echo $receivedData['TransactionDate']; ?></time>)
                                                   </h2>
                                                   <table cellspacing="0" cellpadding="6" style="width:100%;border:1px solid #eee" border="1">
                                                      <thead>
                                                         <tr>
                                                            <th scope="col" style="text-align:left;border:1px solid #eee;padding:12px">Product</th>
                                                            <th scope="col" style="text-align:left;border:1px solid #eee;padding:12px">Quantity</th>
                                                            <th scope="col" style="text-align:left;border:1px solid #eee;padding:12px">Price</th>
                                                         </tr>
                                                      </thead>
                                                      <tbody>
                                                         <tr class="m_858503997237132604order_item">
                                                            <td style="text-align:left;vertical-align:middle;border:1px solid #eee;word-wrap:break-word;padding:12px">Gucci - Flora Gorgeous Gardenia
                                                               Pefume For Women - 100ml (#06056)<br><small></small>
                                                            </td>
                                                            <td style="text-align:left;vertical-align:middle;border:1px solid #eee;padding:12px">1</td>
                                                            <td style="text-align:left;vertical-align:middle;border:1px solid #eee;padding:12px"><span class="m_858503997237132604amount">৳&nbsp;5,950.00</span></td>
                                                         </tr>
                                                      </tbody>
                                                      <tfoot>
                                                         <tr>
                                                            <th scope="row" colspan="2" style="text-align:left;border:1px solid #eee;border-top-width:4px;padding:12px">Subtotal:</th>
                                                            <td style="text-align:left;border:1px solid #eee;border-top-width:4px;padding:12px"><span class="m_858503997237132604amount">৳&nbsp;5,950.00</span></td>
                                                         </tr>
                                                         <tr>
                                                            <th scope="row" colspan="2" style="text-align:left;border:1px solid #eee;padding:12px">Shipping:</th>
                                                            <td style="text-align:left;border:1px solid #eee;padding:12px">Free
                                                               Shipping
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <th scope="row" colspan="2" style="text-align:left;border:1px solid #eee;padding:12px">Payment Method:</th>
                                                            <td style="text-align:left;border:1px solid #eee;padding:12px">cashbaba
                                                               Payment
                                                            </td>
                                                         </tr>
                                                         <tr>
                                                            <th scope="row" colspan="2" style="text-align:left;border:1px solid #eee;padding:12px">Total:</th>
                                                            <td style="text-align:left;border:1px solid #eee;padding:12px"><span class="m_858503997237132604amount">৳&nbsp;5,950.00</span></td>
                                                         </tr>
                                                      </tfoot>
                                                   </table>
                                                   <h2 style="color:#557da1;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:18px;font-weight:bold;line-height:130%;margin:16px 0 8px;text-align:left">Customer details</h2>
                                                   <p style="margin:0 0 16px"><strong>Email:</strong>
                                                      <a href="mailto:borobhi@gmail.com" target="_blank">borobhi@gmail.com</a>
                                                   </p>
                                                   <p style="margin:0 0 16px"><strong>Tel:</strong> 01756307427</p>
                                                   <table cellspacing="0" cellpadding="0" style="width:100%;vertical-align:top" border="0">
                                                      <tbody>
                                                         <tr>
                                                            <td valign="top" width="50%" style="padding:12px">
                                                               <h3 style="color:#557da1;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:16px;font-weight:bold;line-height:130%;margin:16px 0 8px;text-align:left">Billing address</h3>
                                                               <p style="margin:0 0 16px">boro
                                                                  bhi<br>rcis<br>dhanmondi<br>dhaka<br>Dhaka<br>1200<br>Bangladesh
                                                               </p>
                                                            </td>
                                                            <td valign="top" width="50%" style="padding:12px">
                                                               <h3 style="color:#557da1;display:block;font-family:&quot;Helvetica Neue&quot;,Helvetica,Roboto,Arial,sans-serif;font-size:16px;font-weight:bold;line-height:130%;margin:16px 0 8px;text-align:left">Shipping address</h3>
                                                               <p style="margin:0 0 16px">boro
                                                                  bhi<br>rcis<br>dhanmondi<br>dhaka<br>Dhaka<br>1200<br>Bangladesh
                                                               </p>
                                                            </td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                </div>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td align="center" valign="top">
                        <table border="0" cellpadding="10" cellspacing="0" width="600" id="m_858503997237132604template_footer">
                           <tbody>
                              <tr>
                                 <td valign="top" style="padding:0">
                                    <table border="0" cellpadding="10" cellspacing="0" width="100%">
                                       <tbody>
                                          <tr>
                                             <td colspan="2" valign="middle" id="m_858503997237132604credit" style="padding:0 48px 48px 48px;border:0;color:#99b1c7;font-family:Arial;font-size:12px;line-height:125%;text-align:center">
                                                <p>Dhaka
                                                   Fashion – Powered by Recursion
                                                </p>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </td>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
   </tbody>
</table>