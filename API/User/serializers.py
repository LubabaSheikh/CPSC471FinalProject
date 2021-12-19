from rest_framework import serializers
from User.models import Person, Coordinator, Volunteer, Externalvolunteer, Potentialvolunteer


class PersonSerializer(serializers.ModelSerializer):
    class Meta:
        model = Person
        fields = '__all__' # fields = ('attr1', 'attr2', etc)


class VolunteerSerializer(serializers.ModelSerializer):
    class Meta:
        model = Volunteer
        fields = '__all__'

class VolunteerSinSerializer(serializers.ModelSerializer):
    class Meta:
        model = Volunteer
        fields = ["sin"]


class CoordinatorSerializer(serializers.ModelSerializer):
    class Meta:
        model = Coordinator
        fields = '__all__'


class ExternalVolunteerSerializer(serializers.ModelSerializer):
    class Meta:
        model = Externalvolunteer
        fields = '__all__'


class PotentialVolunteerSerializer(serializers.ModelSerializer):
    class Meta:
        model = Potentialvolunteer
        fields = '__all__'