#include "index.h"
#include <fcntl.h>


extern int RB_pinMap[27][27];


void insert_DB(int fp, int gpio_number)
{	
	int fp2;
	char data[2]; // read DB Data (ON / OFF)
	char fpData[100];
	char temp[100];
	char gpioChar[10];
	char test[10] = "1";
	char result[3], gpio_pair[3];
	int i = 0, readResult;

// GPIO�� ����ϰڴ�.
	
	while(i < 26)
	{
		if(gpio_number == RB_pinMap[i][0])
		{
			break;
		}
		else
		{
			i++;
		}
	}
			

	sprintf(gpioChar, "%d", RB_pinMap[i][1]);
	printf("\n\n %s \n",gpioChar);

	gpioExport(gpioChar);
	// fpData�� ��θ� �����Ѵ�.
	gpioDirection(gpioChar, "in");

	// GPIO ���� �����ϱ�
//	gpioDrive(gpioChar, "strong");

	// GPIO �ش��ϴ� �� Ȯ���ϱ�

	// i�� 0�� ��, Level Shifter GPIO�� 0���� ������ش�.

	// ���� gpio_pair�� ���� �о�´�. 0�϶��� ������� ����, �ٸ� ���϶��� ��� (�����ؾߵ�)

	readResult = gpioPair(data_sprintf(gpio_number), gpio_pair);

	if(readResult != 3)
	{
		gpio_pair[readResult] = '\0';
	}
	close(fp2);

	printf("GPIO_PAIR ::::::::::: %s", gpio_pair);

	if(gpio_pair[0] == '0')
	{
		printf("**************************NOPAIR\n");
	}
	else if(gpio_pair[0] > 0)
	{
		printf("**************************SUCCESS\n");
	}

// GPIO ���� �о��. (��ư ���� ����)

	printf("\n\nHello : %s %s \n\n", gpioValueRead(gpioChar),gpioChar);
	strcpy(result, gpioValueRead(gpioChar));

	DBWrite(data_sprintf(gpio_number), result);
	printf("result : %s", result);

// GPIO PAIR (¦) ���� ������. (���� 13���� ����) : �׽�Ʈ ��

//	DBWrite(gpio_pair, result);

	if(result[0] == '0') // ��ư �ȴ�������
	{
		printf("----------------------------------------off \n\n");

		DBWrite(gpio_pair, "0");
	}
	else // ������ ��
	{
		printf("----------------------------------------ONsadsdasd \n\n");
		printf("%s aa\n" , result);

		DBWrite(gpio_pair, "1");
	}

}
