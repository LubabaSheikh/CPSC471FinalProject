from django.db import models
from User.models import Person, Volunteer, Coordinator, Externalvolunteer, Potentialvolunteer, Patient

# Create your models here.

class Seminar(models.Model):
    seminar_id = models.AutoField(primary_key=True)
    name = models.CharField(max_length=500, blank=True, null=True)
    date = models.DateField(blank=True, null=True)
    time = models.TimeField(blank=True, null=True)
    coordinatorassigned = models.ForeignKey('User.Person', models.DO_NOTHING, db_column='coordinatorassigned', blank=True, null=True)

    class Meta:
        managed = False
        db_table = 'seminar'


class Shift(models.Model):
    shift_id = models.IntegerField(primary_key=True)
    date = models.DateField(blank=True, null=True)
    time = models.TimeField(blank=True, null=True)
    place = models.CharField(max_length=500, blank=True, null=True)
    volunteers_assigned = models.IntegerField(blank=True, null=True)

    class Meta:
        managed = False
        db_table = 'shift'


class Assign(models.Model):
    assign_id = models.AutoField(primary_key=True)
    s = models.ForeignKey('Shift', models.DO_NOTHING)
    volunteer = models.ForeignKey('User.Person', models.DO_NOTHING)
    coordinator = models.ForeignKey('User.Person', related_name='coordinator_id', on_delete= models.DO_NOTHING)

    class Meta:
        managed = False
        db_table = 'assign'


class Attends(models.Model):
    sem = models.OneToOneField('Seminar', models.DO_NOTHING, primary_key=True)
    vol = models.ForeignKey('User.Person', models.DO_NOTHING)

    class Meta:
        managed = False
        db_table = 'attends'


class Reflections(models.Model):
    volun = models.ForeignKey(Person, models.DO_NOTHING)
    date = models.DateField(blank=True, null=True)
    comments = models.CharField(max_length=500, blank=True, null=True)

    class Meta:
        managed = False
        db_table = 'reflections'


class Visits(models.Model):
    v_sin = models.OneToOneField(Person, models.DO_NOTHING, db_column='v_sin', primary_key=True)
    r_number = models.ForeignKey(Patient, models.DO_NOTHING, db_column='r_number')

    class Meta:
        managed = False
        db_table = 'visits'