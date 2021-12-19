from django.db import models

# Create your models here.

from User.models import Person, Patient, Coordinator, Volunteer, Externalvolunteer, Potentialvolunteer


class Covidstatus(models.Model):
    person = models.OneToOneField('User.Person', models.DO_NOTHING, primary_key=True)
    vaccine_name = models.CharField(max_length=500, blank=True, null=True)
    vaccine_status = models.IntegerField(blank=True, null=True)

    class Meta:
        managed = False
        db_table = 'covidstatus'


class Equipment(models.Model):
    e = models.ForeignKey('User.Person', models.DO_NOTHING)
    vest = models.IntegerField(blank=True, null=True)
    mask = models.IntegerField(blank=True, null=True)
    keycard = models.IntegerField(blank=True, null=True)

    class Meta:
        managed = False
        db_table = 'equipment'


class Parking(models.Model):
    p = models.ForeignKey('User.Person', models.DO_NOTHING)
    location_id = models.AutoField(primary_key=True)
    car_number = models.IntegerField()
    building = models.CharField(max_length=500, blank=True, null=True)
    valid_until = models.DateField(blank=True, null=True)

    class Meta:
        managed = False
        db_table = 'parking'



class Rewards(models.Model):
    reward_id = models.AutoField(primary_key=True)
    vol_sin = models.ForeignKey(Person, models.DO_NOTHING, db_column='vol_sin', null = True)
    coor_sin = models.ForeignKey(Person, models.DO_NOTHING, db_column='coor_sin', related_name='coor_sin', null=True)
    comments = models.CharField(max_length=500, blank=True, null=True)
    pointsofvolunteer = models.IntegerField(db_column='pointsOfVolunteer', blank=True, null=True)  # Field name made lowercase.
    date = models.DateField(blank=True, null=True)
    referrals = models.CharField(max_length=500, blank=True, null=True)

    class Meta:
        managed = False
        db_table = 'rewards'





