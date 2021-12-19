from django.db import models

# Create your models here.

class Person(models.Model):
    sin = models.IntegerField(db_column='SIN') #, primary_key=True)  # Field name made lowercase.
    password = models.CharField(max_length=500, null = True)
    fname = models.CharField(db_column='FName', max_length=500, null = True)  # Field name made lowercase.
    minit = models.CharField(db_column='Minit', max_length=5, blank=True, null=True)  # Field name made lowercase.
    lname = models.CharField(db_column='LName', max_length=500, null = True)  # Field name made lowercase.
    bdate = models.DateField(db_column='BDate', null = True)  # Field name made lowercase.
    gender = models.CharField(db_column='Gender', max_length=500, null = True)  # Field name made lowercase.
    pronouns = models.CharField(db_column='Pronouns', max_length=45, blank=True, null=True)  # Field name made lowercase.
    # equipment = models.AutoField(db_column='Equipment', primary_key=True, unique=True)  # Field name made lowercase.
    backgroundcheck = models.IntegerField(db_column='BackgroundCheck', null = True)  # Field name made lowercase.
    role = models.CharField(db_column='Role', max_length=500, null = True)  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'person'



class Volunteer(models.Model):
    v = models.OneToOneField(Person, models.DO_NOTHING, primary_key=True)
    start_date = models.DateField(blank=True, null=True)
    training_year = models.IntegerField(blank=True, null=True)
    training_level = models.IntegerField(blank=True, null=True)

    class Meta:
        managed = False
        db_table = 'volunteer'


class Potentialvolunteer(models.Model):
    pv = models.OneToOneField(Person, models.DO_NOTHING, primary_key=True)
    coor = models.ForeignKey(Person, related_name = 'coor_id', on_delete= models.DO_NOTHING)
    backgroundcheckstatus = models.IntegerField(db_column='backgroundCheckStatus', blank=True, null=True)  # Field name made lowercase.
    referral = models.CharField(max_length=500, blank=True, null=True)

    class Meta:
        managed = False
        db_table = 'potentialvolunteer'



class Coordinator(models.Model):
    c = models.OneToOneField('Person', models.DO_NOTHING, primary_key=True)
    salary = models.FloatField(blank=True, null=True)

    class Meta:
        managed = False
        db_table = 'coordinator'



class Externalvolunteer(models.Model):
    ev = models.OneToOneField('Person', models.DO_NOTHING, primary_key=True)
    specialty = models.CharField(max_length=500, blank=True, null=True)
    affiliated_company = models.CharField(max_length=500, blank=True, null=True)
    pet_visit_flag = models.IntegerField(blank=True, null=True)
    spirit_flag = models.IntegerField(blank=True, null=True)
    pet_name = models.CharField(max_length=500, blank=True, null=True)
    pet_type = models.CharField(max_length=500, blank=True, null=True)
    faith = models.CharField(max_length=500, blank=True, null=True)

    class Meta:
        managed = False
        db_table = 'externalvolunteer'



class Patient(models.Model):
    room_number = models.AutoField(primary_key=True)
    fname = models.CharField(db_column='Fname', max_length=500, blank=True, null=True)  # Field name made lowercase.
    lname = models.CharField(db_column='Lname', max_length=500, blank=True, null=True)  # Field name made lowercase.
    gender = models.CharField(max_length=500, blank=True, null=True)
    bdate = models.DateField(db_column='BDate', blank=True, null=True)  # Field name made lowercase.
    pronouns = models.CharField(max_length=500, blank=True, null=True)
    floor = models.IntegerField(blank=True, null=True)

    class Meta:
        managed = False
        db_table = 'patient'


