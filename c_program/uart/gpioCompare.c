#include "index.h"
#include <unistd.h>
#include <fcntl.h>

#define DEBUG

void insertCompare(char *index, char *gpioNumber)
{
	char result[5];
	
	strcpy(result, gpioNumber);
	result[strlen(gpioNumber) - 1] = '\0';

	DBWrite(result, index);
}

int gpioCompare(int fp, int gpio_number)
{
	char		compare[255];
	char		compareIndex[255];
	char		compareResult[255];
	char		gpioData[255];
	char		gpioLocation[100];
	char		fpCompareLocation[255]; // compare DB �ּҰ� ����ȴ�.
	char		fpResult[100];
	char		compareNumber[255];

	int			fpCompare, resultTotal, counter = 0, i = 0, j = 0;
	int			fpResultSize;

// ���� gpio_compare �����Ѵ�.
	strcpy(fpCompareLocation, "/usr/local/apache/htdocs/project_os/DB/gpio_compare/");
	strcat(fpCompareLocation, data_sprintf(gpio_number));

	printf("\n***********gpioCompare**************\n");
	printf("fpCompareLocation : %s", fpCompareLocation);

	//exit(0);

	fpCompare	=  open(fpCompareLocation, O_RDONLY, S_IRUSR);

// open ������ ���� ���
	if ( fpCompare == -1 )
	{
		perror("open : fpCompare");
		close(fpCompare);
		
		return 0;
	}

// gpio_compare���� 255����Ʈ ��ŭ ���� �о��. ( gpio compare��ȣ, ����, �� )
	resultTotal = read(fpCompare, fpResult, 100);
	fpResult[resultTotal] = '\0';

#ifdef DEBUG
	printf("--------------------fpResult\n%s", fpResult);
#endif
	close(fpCompare);

// ���̰� 2���� ���� ���, DB�� �� �� ����Ǿ��ٰ� �Ǵ�
	if(strlen(fpResult) < 5)
	{
		printf("DB Compare Error\n");
		return 0;
	}
	else
	{

// ������ ������ ���� ��� �ݺ��ؼ� ���� �����͸� �����´�.
		while(1)
		{
			i = 0;

			// gpio ��ȣ
			while(1)
			{
				compareNumber[i++] = fpResult[j];
			
				if(fpResult[j++] == ' ')
				{
					compareNumber[i] = '\0';
#ifdef DEBUG
					printf("\n1. compareNumber %s\n", compareNumber);
#endif
					break;	
				}
			}
			// �� ���� ( == : 0, > : 1, >= : 2, < : 3, <= : 4)
			i = 0;
			while(1)
			{
				compare[i++] = fpResult[j]; // �� ���� ���� �Էµȴ�.

				if(fpResult[j++] == ' ')
				{
					compare[i] = '\0';
#ifdef DEBUG
					printf("3. compareNumber %s \t Memory : %u \n", compareNumber, compareNumber);
					printf("4. compareNumber %s \n", compareNumber);
#endif
					break;	
				}
			}
			i = 0;
			while(1)
			{
				gpioData[i++] = fpResult[j]; // �� ���� ���� �Էµȴ�.

				if(fpResult[j++] == ' ')
				{
					gpioData[i - 1] = '\0';
#ifdef DEBUG
					printf("3. compareNumber %s \t Memory : %u \n", compareNumber, compareNumber);
					printf("4. compareNumber %s \n", compareNumber);
#endif
					break;	
				}
			}
			i = 0;
			// �� ��

			while(1)
			{

#ifdef DEBUG
				printf("6. compare %s \n", compare);
#endif

				compareIndex[i++]	=	fpResult[j++];

				if(fpResult[j] == '\n' | fpResult[j] == '\0')
				{
					printf("success\n");
					compareIndex[i] = '\0';

#ifdef DEBUG3
					printf("HI!!\n");
					printf("6. compareIndex %s\n", compareIndex);
#endif			

	// GPIO DB �ּҸ� �����Ѵ�. GPIO ���� compareIndex ���� ���ϱ� ����
					strcpy(gpioLocation, "/usr/local/apache/htdocs/project_os/DB/gpio/");
					strcat(gpioLocation, data_sprintf(gpio_number));

	// ������ �ּҸ� ������.
					fpCompare = open(gpioLocation, O_RDONLY, S_IRUSR);

					if(fpCompare == -1)
					{
						perror("fpCompare : ");
//						exit(0);
					}

	// ������ �ּҿ��� 100 ����Ʈ��ŭ �о�´�.
					if((resultTotal = read(fpCompare, compareResult, 20)) == -1)
					{
						perror("resultTotal : ");
					}
					compareResult[resultTotal] = '\0';

					printf("\n\n���� �� : %s", compareResult);
					close(fpCompare);

					if(compare[0] == '0')
					{
						printf("\n ���� \n");
						printf("compareResult = %s \t compareIndex = %s", compareResult, compareIndex);

						if(atoi(compareResult) == atoi(compareIndex))
						{
							printf("\n gpioData : %c, compareNumber : %s\n", gpioData[0], compareNumber);
							insertCompare(gpioData, compareNumber);
							gpioVariable(gpio_number);
						}
					}
					else if(compare[0] == '1')
					{
						if(atoi(compareResult) > atoi(compareIndex))
						{
							printf("����");
							insertCompare(gpioData, compareNumber);
							gpioVariable(gpio_number);
						}
					}
					else if(compare[0] == '2')
					{
						if(atoi(compareResult) >= atoi(compareIndex))
						{
							printf("����");
							insertCompare(gpioData, compareNumber);
							gpioVariable(gpio_number);
						}
					}
					else if(compare[0] == '3')
					{
						printf("\n ���� �۴� ");
						if(atoi(compareResult) < atoi(compareIndex))
						{
							insertCompare(gpioData, compareNumber);
							gpioVariable(gpio_number);
						}
					}
					else if(compare[0] == '4')
					{
						
						printf("\n �۰ų� ���� ");
						if(atoi(compareResult) <= atoi(compareIndex))
						{
							insertCompare(gpioData, compareNumber);
							gpioVariable(gpio_number);
						}
					}
					else
					{
						printf("\n �ƹ������� ���� ");
					}

					if(fpResult[j] == '\0')
					{
						close(fpCompare);
						return;
					}
					if(fpResult[j] == '\n')
					{
						j++;
					}
					close(fpCompare);
					break;	
				}
			}
		}
	}

	
	return 1;
}