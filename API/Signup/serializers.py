from rest_framework import serializers
from Signup.models import Shift, Seminar, Assign, Attends, Reflections
from User.serializers import VolunteerSinSerializer


class ShiftSerializer(serializers.ModelSerializer):
    class Meta:
        model = Shift
        fields = '__all__' # fields = ('attr1', 'attr2', etc)


class ShiftDateSerializer(serializers.ModelSerializer):
    class Meta:
        model = Shift
        fields = ["date"] # fields = ('attr1', 'attr2', etc)


class ShiftTimeSerializer(serializers.ModelSerializer):
    class Meta:
        model = Shift
        fields = ["time"] # fields = ('attr1', 'attr2', etc)

class ShiftPlaceSerializer(serializers.ModelSerializer):
    class Meta:
        model = Shift
        fields = ["place"] # fields = ('attr1', 'attr2', etc)


class SeminarSerializer(serializers.ModelSerializer):
    class Meta:
        model = Seminar
        fields = '__all__'


class SeminarNameSerializer(serializers.ModelSerializer):
    class Meta:
        model = Seminar
        fields = ["name"]


class SeminarDateSerializer(serializers.ModelSerializer):
    class Meta:
        model = Seminar
        fields = ["date"]

class SeminarTimeSerializer(serializers.ModelSerializer):
    class Meta:
        model = Seminar
        fields = ["time"]


class SeminarCoordinatorSerializer(serializers.ModelSerializer):
    class Meta:
        model = Seminar
        fields = ["coordinatorassigned"]




class AssignSerializer(serializers.ModelSerializer):
    class Meta:
        model = Assign
        fields = ["s_id", "volunteer_id"] # fields = ('attr1', 'attr2', etc)


class AttendsSerializer(serializers.ModelSerializer):
    sem = serializers.IntegerField(required = False)
    class Meta:
        model = Attends
        fields = '__all__'



class ReflectionSerializer(serializers.ModelSerializer):
    class Meta:
        model = Reflections
        fields = ["volun_id", "date", "comments"]

     #IMPORTANT PART
    def to_representation(self, instance):

        self.fields['volun_id'] =  VolunteerSinSerializer(read_only=True)
        return super(ReflectionSerializer, self).to_representation(instance)

        # SECOND SOLN
        # print("HEREEEE")
        # response = super().to_representation(instance)
        # response['volun'] = VolunteerSinSerializer(instance.volun).data
        # return response