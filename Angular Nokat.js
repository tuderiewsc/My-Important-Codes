================ environment.prod.ts ================
 export const environment = {
    production: true,
    hmr       : false,
    apiUrl: 'https://isee.sisoog.com'
}; 
================ environment.prod.ts ================

 async checkLogin() {
        let res = await axios.get(`${environment.apiUrl}/api/v1/auth/sessions/mine`, {
            // headers: {'Content-Type': 'application/json', },
            // responseType : "json" ,
            withCredentials: true,
        }).then((res) => {
            return res.status == 200 ? res : false
            // return res
        }).catch((err) => {
            return false
        });
        return res;
}

--------------------------------------------------------
===Resolve===
IN module::
const routes = [
    {
        path     : 'sample',
        component: SampleComponent,
        resolve  : {
            data: ProjectSampleService 
        },
    }
];
IN Service::
resolve(route: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<any> | Promise<any> | any {

        return new Promise((resolve, reject) => {

            Promise.all([
                this.getCurrency(this.id, this.id2)
            ]).then(
                () => {
                    resolve();
                },
                reject
            );
        });
    }
	
getCurrency(id,id2): Promise<any> {
        if(id != null){
            this.date = id;
            this.date2 = id2;
            this.url = `${environment.apiUrl}/api/v1/currency?currency_name=chinese_yuan&date=${this.date}&end=${this.date2}`
        }else{
            // return null;
            const d = new Date();
            // const date = d.setDate(-1);
            this.date = d.setHours(-1); 
            this.url = `${environment.apiUrl}/api/v1/currency?currency_name=chinese_yuan&date=${this.date}`
        }
        
        return new Promise((resolve, reject) => {
            this._httpClient.get(this.url, { withCredentials: true })
                .subscribe((response: any) => {
                    this.stats = response;
                    resolve(response);
                }, reject); 
        });
    }
	
	-----------------------------
	async login(username, password) {
        let response = await axios.post(`${environment.apiUrl}/api/v1/auth/sessions`, {
            username: `${username}`,
            password: `${password}`
        }, { withCredentials: true }).then((res) => {
            localStorage.setItem('currentUser', JSON.stringify(res.data));
            this.currentUserSubject.next(res.data);
            return res.status;
        }
        ).catch((err) =>
            this.openDialog()
        );

        return response;

    }
	async logout() {
        // remove user from local storage and set current user to null
        localStorage.removeItem('currentUser');
        localStorage.removeItem('data');
        localStorage.removeItem('dataMine');

        var expire = new Date();
        var time = Date.now() + ((3600 * 1000) * 6); // current time + 6 hours ///
        expire.setTime(time);
        let res = await axios.delete(`${environment.apiUrl}/api/v1/auth/sessions`, {
            withCredentials: true,
        }).then((res) => {
            this.cookieService.set('sid', '', expire);
            return res.status;
        }).catch((err) => { });
        this.currentUserSubject.next(null);
        return res;
    }



 deleteRowData(row_obj) {
    this.dataSourceAttr = this.dataSourceAttr.filter((value, key) => {
      return value.name != row_obj.name;
    });
  }
  
  
  
      private _location: Location,
          this._location.go('apps/e-commerce/category/' + res);

