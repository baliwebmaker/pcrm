export default{
    methods: {
        assignPermission(permisi){
            const indexpermisi =  this.unassignedPermissions.indexOf(permisi);

            this.assignedPermissions.push({ id: permisi.id, name: permisi.name});

            this.unassignedPermissions.splice(indexpermisi,1);
        },

        unassignPermission(permisi){
            const indexpermisi =  this.assignedPermissions.indexOf(permisi);

            this.unassignedPermissions.push({ id: permisi.id, name: permisi.name});

            this.assignedPermissions.splice(indexpermisi,1);
        }
    }
}