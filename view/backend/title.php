

<div style="width:99%; height:87%; margin:auto; overflow:auto; border:#666 1px solid;">
	<p class="t cent botli"><?= $header; ?></p>
	<form method="post" target="back" action="./api/update.php">
		<table width="100%">
			<tbody>
				<tr class="yel">
					<td width="45%">網站標題</td>
					<td width="23%">替代文字</td>
					<td width="7%">顯示</td>
					<td width="7%">刪除</td>
					<td></td>
				</tr>

				<tr class="yel">
					<td width="45%"></td>
					<td width="23%"></td>
					<td width="7%"></td>
					<td width="7%"></td>
					<td></td>
				</tr>

			</tbody>
		</table>
		<table style="margin-top:40px; width:70%;">
			<tbody>
				<tr>
					<td width="200px"><input type="button" onclick="op('#cover','#cvr','<?=$modal;?>')" value="<?=$addBtn;?>"></td>
					<td class="cent">
						<input type="hidden" name="table" value='<?=$table;?>'>
						<input type="submit" value="修改確定">
						<input type="reset" value="重置">
					</td>
				</tr>
			</tbody>
		</table>

	</form>
</div>