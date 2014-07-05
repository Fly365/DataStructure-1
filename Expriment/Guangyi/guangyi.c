#include<stdio.h>
#define MAX 100
typedef struct
{
    int i,j;
    int tri;
}triple;
typedef struct{
  triple date[MAX+1];
  int mu,nu;
  int tu;
}Matrix;
void init(Matrix *m)
{

    int k;
    printf("����������������������");
    scanf("%d",&(*m).mu);
    scanf("%d",&(*m).nu);
    printf("���������Ԫ�صĸ�����");
    scanf("%d",&(*m).tu);
    printf("��ֱ�������%d������Ԫ�ص����±꣬���±꣬������ֵ:",(*m).tu);
    for(k=1;k<=(*m).tu;k++)
        scanf("%d%d%d",&(*m).date[k].i,&(*m).date[k].j,&(*m).date[k].tri);
}
void print(Matrix m){
    int k,p;
    int n=1;
    for(k=1;k<=m.mu;k++){
        for(p=1;p<=m.nu;p++){
            if(k==m.date[n].i&&p==m.date[n].j){
                printf("%d ",m.date[n].tri);
                n++;
            }
            else printf("0 ");
}
printf("\n");
}
}

void Transmat(Matrix m,Matrix *n)//����һ ����M����ȥɨ�����е�date��������ֵһ����ʱ�� ��ɨ�赽�Ŀ϶���С��������n���ŵ�λ������ȷ��
{
    (*n).mu=m.mu;
    (*n).nu=m.nu;
    (*n).tu=m.tu;
    int k,p;
    int q=1;
    for(k=1;k<=m.nu;k++)
        for(p=1;p<=m.tu;p++)
        if(m.date[p].j==k)
            {
            (*n).date[q].i=m.date[p].j;
            (*n).date[q].j=m.date[p].i;
            (*n).date[q].tri=m.date[p].tri;
            q++;
            }

}
void Transmat2(Matrix m,Matrix *n)//����2 ����ת�� ���ÿһ���з���Ԫ�� ���� ���Լ���һ������Ԫ��λ�á�
{
    int k;int col;
    int q;
    int num[m.nu+1];
    int cpot[m.nu+1];
    (*n).mu=m.mu;
    (*n).nu=m.nu;
    (*n).tu=m.tu;
    for(k=1;k<=m.nu;k++)
        num[k]=0;
    for(k=1;k<=m.tu;k++)
        num[m.date[k].j]++;
    cpot[1]=1;
    for(k=2;k<m.nu;k++)
        cpot[k]=cpot[k-1]+num[k-1];
    for(k=1;k<=m.tu;k++)
    {
        col=m.date[k].j;
        q=cpot[col];
        (*n).date[q].i=m.date[k].j;
        (*n).date[q].j=m.date[k].i;
        (*n).date[q].tri=m.date[k].tri;
        cpot[col]++;
    }
}
int main()
{
    Matrix m,n,p;
    init(&m);
    printf("���ķ���Ԫ����Ϊ��");
    printf("%d\n",m.tu);
    printf("���ĳ�ʼ����Ϊ��\n");
    print(m);
    printf("\n");
    Transmat(m,&n);
    printf("ͨ����һ�ַ����õ���ת�þ���Ϊ��\n");
    print(n);
    printf("\n");
    Transmat(m,&p);
     printf("ͨ���ڶ��ַ����õ���ת�þ���Ϊ��\n");
    print(p);
    return 0;
}

