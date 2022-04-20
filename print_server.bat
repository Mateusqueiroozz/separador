echo off
COLOR CF
@title Servidor de impressao
echo Aguardando impressoes..
 
:loop

		
		if exist C:\xampp\htdocs\separador\impressao\imp_1_*.txt (
			echo Imprimindo em Cohama - Depósito 91
			Type C:\xampp\htdocs\separador\impressao\imp_1_*.txt > \\192.168.253.104\teste_epson
			del C:\xampp\htdocs\separador\impressao\imp_1_*.txt
		) 
		@TIMEOUT /T 5 /NOBREAK
cls

goto loop

pause >nul