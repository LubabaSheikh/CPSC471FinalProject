from rest_framework import serializers
from Addons.models import Covidstatus, Parking, Equipment, Rewards
from rest_framework.fields import IntegerField



class CovidstatusSerializer(serializers.ModelSerializer):
    class Meta:
        model = Covidstatus
        fields = '__all__'


class ParkingSerializer(serializers.ModelSerializer):
    class Meta:
        model = Parking
        fields = '__all__'

class EquipmentSerializer(serializers.ModelSerializer):
    class Meta:
        model = Equipment
        fields = '__all__'


class RewardsSerializer(serializers.ModelSerializer):
    # vol_sin = serializers.IntegerField(required = False)
    # coor_sin = serializers.IntegerField(required = False)
    class Meta:
        model = Rewards
        fields = '__all__'