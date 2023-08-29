<div class="di"
				style="height:540px; border:#999 1px solid; width:76.5%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
				<!--正中央-->
				<table width="100%">
					<tbody>
						<tr>
							<td style="width:70%;font-weight:800; border:#333 1px solid; border-radius:3px;"
								class="cent"><a href="?do=admin" style="color:#000; text-decoration:none;">後台管理區</a>
							</td>
							<td><button onclick="document.cookie=&#39;user=&#39;;location.replace(&#39;?&#39;)"
									style="width:99%; margin-right:2px; height:50px;">管理登出</button></td>
						</tr>
					</tbody>
				</table>
				<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
					<p class="t cent botli">網站標題管理</p>
					<form method="post" target="back" action="?do=tii">
						<table width="100%">
							<tbody>
								<tr class="yel">
									<td width="45%">網站標題</td>
									<td width="23%">替代文字</td>
									<td width="7%">顯示</td>
									<td width="7%">刪除</td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<table style="margin-top:40px; width:70%;">
							<tbody>
								<tr>
									<td width="200px"><input type="button"
											onclick="op(&#39;#cover&#39;,&#39;#cvr&#39;,&#39;view.php?do=title&#39;)"
											value="新增網站標題圖片"></td>
									<td class="cent"><input type="submit" value="修改確定"><input type="reset" value="重置">
									</td>
								</tr>
							</tbody>
						</table>

					</form>
				</div>
			</div>
			<div id="alt"
				style="position: absolute; width: 350px; min-height: 100px; word-break:break-all; text-align:justify;  background-color: rgb(255, 255, 204); top: 50px; left: 400px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;">
			</div>
			<script>
				$(".sswww").hover(
					function () {
						$("#alt").html("" + $(this).children(".all").html() + "").css({ "top": $(this).offset().top - 50 })
						$("#alt").show()
					}
				)
				$(".sswww").mouseout(
					function () {
						$("#alt").hide()
					}
				)
			</script>