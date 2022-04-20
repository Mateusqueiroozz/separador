echo off
COLOR CF
@title Servidor de impressao
echo Aguardando impressoes..
 
:loop

		
		if exist impressao\imp_1_*.txt (
			echo Imprimindo em Cohama
			Type impressao\imp_1_*.txt > 
			del impressao\imp_1_*.txt
		) 
		
		
		if exist impressao\imp_7_*.txt (
			echo Imprimindo em Cohama - Deposito
			Type impressao\imp_7_*.txt > \\192.168.253.97\l42
			del impressao\imp_7_*.txt
		) 
		
		
		if exist impressao\imp_3_*.txt (
			echo Imprimindo em Guajajaras
			Type impressao\imp_3_*.txt > \\192.168.254.88/zebra_l30vc01
			del impressao\imp_3_*.txt
		) 
		
		
		if exist impressao\imp_5_*.txt (
			echo Imprimindo em Guajajaras - Deposito
			Type impressao\imp_5_*.txt > \\192.168.254.181\imp_dep_celso
			del impressao\imp_5_*.txt
		) 
		
		
		if exist impressao\imp_2_*.txt (
			echo Imprimindo em Sao Francisco
			Type impressao\imp_2_*.txt > \\192.168.252.23\zebra_l20
			del impressao\imp_2_*.txt
		) 
		
		
		if exist impressao\imp_4_*.txt (
			echo Imprimindo em Sao Francisco - Deposito
			Type impressao\imp_4_*.txt > \\192.168.252.111\tlpdepositosf
			del impressao\imp_4_*.txt
		) 
		
		
		if exist impressao\imp_8_*.txt (
			echo Imprimindo em Sao Francisco - Recebimento
			Type impressao\imp_8_*.txt > \\192.168.252.114\elginrecebsf
			del impressao\imp_8_*.txt
		) 
		@TIMEOUT /T 1 /NOBREAK


goto loop

pause >nul