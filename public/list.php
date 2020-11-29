<table style="max-width:80%;">
	<tr>
		<th><?php esc_html_e( 'Date: ', 'suggestions' ); ?></th>
		<th><?php esc_html_e( 'Name: ', 'suggestions' ); ?></th>
		<th><?php esc_html_e( 'Lastname: ', 'suggestions' ); ?></th>
		<th><?php esc_html_e( 'Mail: ', 'suggestions' ); ?></th>
		<th><?php esc_html_e( 'Suggestion: ', 'suggestions' ); ?></th>
	</tr>
	<?php foreach ($results as $key => $value) { ?>
		<tr>
			<td><?php echo date_i18n('l d/m/Y - g:i', strtotime($value->created)); ?></td>
			<td><?php echo $value->name; ?></td>
			<td><?php echo $value->lastname; ?></td>
			<td><?php echo $value->mail; ?></td>
			<td><?php echo $value->suggestion; ?></td>
		</tr>
	<?php } ?>
</table>