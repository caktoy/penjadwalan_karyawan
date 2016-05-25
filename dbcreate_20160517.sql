/*==============================================================*/
/* DBMS name:      PostgreSQL 8                                 */
/* Created on:     5/17/2016 3:16:17 PM                         */
/*==============================================================*/


drop table JADWAL;

drop index KOTA_PK;

drop table KOTA;

drop index PROVINSI_PK;

drop table PROVINSI;

drop index SITE_PK;

drop table SITE;

drop index TEKNISI_PK;

drop table TEKNISI;

/*==============================================================*/
/* Table: JADWAL                                                */
/*==============================================================*/
create table JADWAL (
   TANGGAL              DATE                 not null,
   ID_TEKNISI           CHAR(4)              not null,
   ID_SITE              CHAR(4)              null,
   KETERANGAN           VARCHAR(1)           null,
   constraint PK_JADWAL primary key (TANGGAL, ID_TEKNISI)
);

/*==============================================================*/
/* Table: KOTA                                                  */
/*==============================================================*/
create table KOTA (
   ID_KOTA              CHAR(4)              not null,
   ID_PROVINSI          CHAR(3)              null,
   NAMA_KOTA            VARCHAR(50)          null,
   STATUS               VARCHAR(1)           null,
   constraint PK_KOTA primary key (ID_KOTA)
);

/*==============================================================*/
/* Index: KOTA_PK                                               */
/*==============================================================*/
create unique index KOTA_PK on KOTA (
ID_KOTA
);

/*==============================================================*/
/* Table: PROVINSI                                              */
/*==============================================================*/
create table PROVINSI (
   ID_PROVINSI          CHAR(3)              not null,
   NAMA_PROVINSI        VARCHAR(50)          null,
   STATUS               VARCHAR(1)           null,
   constraint PK_PROVINSI primary key (ID_PROVINSI)
);

/*==============================================================*/
/* Index: PROVINSI_PK                                           */
/*==============================================================*/
create unique index PROVINSI_PK on PROVINSI (
ID_PROVINSI
);

/*==============================================================*/
/* Table: SITE                                                  */
/*==============================================================*/
create table SITE (
   ID_SITE              CHAR(4)              not null,
   ID_KOTA              CHAR(4)              null,
   NAMA_SITE            VARCHAR(50)          null,
   NO_TELP_SITE         VARCHAR(15)          null,
   ALAMAT_SITE          VARCHAR(100)         null,
   STATUS               VARCHAR(1)           null,
   constraint PK_SITE primary key (ID_SITE)
);

/*==============================================================*/
/* Index: SITE_PK                                               */
/*==============================================================*/
create unique index SITE_PK on SITE (
ID_SITE
);

/*==============================================================*/
/* Table: TEKNISI                                               */
/*==============================================================*/
create table TEKNISI (
   ID_TEKNISI           CHAR(4)              not null,
   ID_KOTA              CHAR(4)              null,
   NAMA_TEKNISI         VARCHAR(100)         null,
   ALAMAT_TEKNISI       VARCHAR(100)         null,
   NO_TELP_TEKNISI      VARCHAR(15)          null,
   EMAIL_TEKNISI        VARCHAR(50)          null,
   TANGGAL_LAHIR_TEKNISI DATE                 null,
   AGAMA_TEKNISI        VARCHAR(15)          null,
   JENIS_KELAMIN_TEKNISI VARCHAR(15)          null,
   STATUS               VARCHAR(1)           null,
   constraint PK_TEKNISI primary key (ID_TEKNISI)
);

/*==============================================================*/
/* Index: TEKNISI_PK                                            */
/*==============================================================*/
create unique index TEKNISI_PK on TEKNISI (
ID_TEKNISI
);

alter table JADWAL
   add constraint FK_JADWAL_REFERENCE_TEKNISI foreign key (ID_TEKNISI)
      references TEKNISI (ID_TEKNISI)
      on delete restrict on update restrict;

alter table JADWAL
   add constraint FK_JADWAL_REFERENCE_SITE foreign key (ID_SITE)
      references SITE (ID_SITE)
      on delete restrict on update restrict;

alter table KOTA
   add constraint FK_KOTA_REFERENCE_PROVINSI foreign key (ID_PROVINSI)
      references PROVINSI (ID_PROVINSI)
      on delete restrict on update restrict;

alter table SITE
   add constraint FK_SITE_REFERENCE_KOTA foreign key (ID_KOTA)
      references KOTA (ID_KOTA)
      on delete restrict on update restrict;

alter table TEKNISI
   add constraint FK_TEKNISI_REFERENCE_KOTA foreign key (ID_KOTA)
      references KOTA (ID_KOTA)
      on delete restrict on update restrict;

