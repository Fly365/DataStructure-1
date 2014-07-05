#include <stdio.h>
#define INIT_LIST_SIZE 100
#define LIST_INCREMENT 10
typedef struct{
    char name[20];
    char number[20];
    char job[20];
}Worker;

typedef struct{
    Worker *elem;
    int length;
    int listsize;
}SQlist;

SQlist InitList(int n)
{
    SQlist l;
    l.elem = (Worker *)malloc(INIT_LIST_SIZE*sizeof(Worker));   //mallocǰд SQlist * Ҳ��  Ϊʲô��
    if (!l.elem)
        exit(1);
    int i;
    char name[20], number[20], job[20];
    Worker worker;

    for (i=0;i<n;i++)
    {
        printf("�����������%d��Ա�������������ţ�ְ��\n", i+1);
        scanf("%s", name);
        scanf("%s", number);
        scanf("%s", job);
        strcpy(worker.name, name);
        strcpy(worker.number, number);
        strcpy(worker.job, job);
        l.elem[i] = worker;
    }
    l.length = n;
    l.listsize = INIT_LIST_SIZE;
    printf("######��ʼ���ɹ�######\n");
    return l;
}

void printlist(SQlist l)
{
    int i;
    Worker worker;
    for (i=0;i<l.length;i++)
    {
        worker = l.elem[i];
        printf("��%d��Ա������Ϣ��\n", i+1);
        printf("����: %s\n", worker.name);
        printf("����: %s\n", worker.number);
        printf("ְ��: %s\n", worker.job);
        printf("\n");
    }
}

SQlist insertlist(SQlist l, Worker worker, int i)
{
    Worker *q, *p;
    if (i<1 || i>l.length+1)
    {
        printf("insert:the error i\n");
        exit(1);
    }
    q = &(l.elem[i-1]);
    for (p=&(l.elem[l.length-1]);p>=q;p--)
        *(p+1) = *p;
    *q = worker;
    l.length++;
    printf("######������Ա���ɹ�######\n");
    return l;
}

SQlist deletelist(SQlist l, int i)
{
    Worker *p, *q;
    if (i<1 || i>l.length)
    {
        printf("insert:the error i\n");
        exit(1);
    }
    p = &(l.elem[i-1]);
    q = &(l.elem[l.length-1]);
    for (++p;p<=q;++p)
        *(p-1) = *p;
    l.length--;
    printf("######ɾ����ְԱ���ɹ�######\n");
    return l;
}

Worker addnewworker()
{
    Worker worker;
    char name[20], number[20], job[20];
    printf("��������������ְԱ�������������ţ�ְ��:\n");
    scanf("%s", name);
    scanf("%s", number);
    scanf("%s", job);
    strcpy(worker.name, name);
    strcpy(worker.number, number);
    strcpy(worker.job, job);
    return worker;
}

SQlist INIT(SQlist l)
{
    int n;
    printf("-----------------------------\n");
    printf("*********��ʼ��Ա��**********\n");
    printf("-----------------------------\n");
    printf("�������ʼ��Ա���������� ");
    scanf("%d", &n);
    l = InitList(n);
    printlist(l);
    return l;
}

SQlist ADD(SQlist l)
{
    printf("-----------------------------\n");
    printf("*********��ְ��Ա��**********\n");
    printf("-----------------------------\n");
    Worker worker;
    worker = addnewworker();
    int i;
    printf("���������Ա������˳����λ��: \n");
    scanf("%d", &i);
    l = insertlist(l, worker, i);
    printlist(l);
    return l;
}

SQlist DELETE(SQlist l)
{
    printf("-----------------------------\n");
    printf("**********Ա����ְ**********\n");
    printf("-----------------------------\n");
    printf("������Ҫɾ����Ա����λ��:\n");
    int i;
    scanf("%d", &i);
    l = deletelist(l, i);
    printlist(l);
    return l;
}

void showmenu()
{
    SQlist l;
    printf("##########################################################\n");
    printf("------------------------Ա����Ϣϵͳ----------------------\n");
    printf("##########################################################\n");
    printf("��һ��ʹ��ǰ���ȳ�ʼ��Ա��˳���\n");
    l = INIT(l);

    int select;
    while (1)
    {
        printf("��ѡ�������\n");
        printf("1����������ְԱ��\n");
        printf("2��ɾ����ְԱ��\n");
        printf("0���˳�\n");
        scanf("%d", &select);
        switch(select)
        {
            case 1:l = ADD(l);break;
            case 2:l = DELETE(l);break;
            case 0:exit(1);break;
            default:printf("��������---\n");
        }
    }
}

void main()
{
    showmenu();
}






































