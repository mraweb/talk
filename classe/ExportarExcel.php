<?php
class ExportarExcel
{
	/**
	 * @author Rodrigo Régis Palmeira
	 * @link http://www.rodrigoregis.com.br
	 * @param string $html
	 * @return file.xls
	 */
	public static function toXLS($html,$nomeArquivo)
	{
		header("Content-type: application/vnd.ms-excel");
		header("Content-type: application/force-download");
		header("Content-Disposition: attachment; filename=$nomeArquivo");
		header("Pragma: no-cache");
		echo utf8_decode($html);
		exit();
	}
}