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


    /* Set Metas */
    app.component =>
    ngOnInit() {

        this.router.events.pipe(
          filter(event => event instanceof NavigationEnd),
          )
        .subscribe(() => {

            var rt = this.getChild(this.activatedRoute)

            rt.data.subscribe(data => {
              console.log(data);
              this.titleService.setTitle(data.title)

              if (data.descrption) {
                this.metaService.updateTag({ name: 'description', content: data.descrption })
            } else {
                this.metaService.removeTag("name='description'")
            }

            if (data.robots) {
                this.metaService.updateTag({ name: 'robots', content: data.robots })
            } else {
                this.metaService.updateTag({ name: 'robots', content: "follow,index" })
            }

            if (data.ogUrl) {
                this.metaService.updateTag({ property: 'og:url', content: data.ogUrl })
            } else {
                this.metaService.updateTag({ property: 'og:url', content: this.router.url })
            }

            if (data.ogTitle) {
                this.metaService.updateTag({ property: 'og:title', content: data.ogTitle })
            } else {
                this.metaService.removeTag("property='og:title'")
            }

            if (data.ogDescription) {
                this.metaService.updateTag({ property: 'og:description', content: data.ogDescription })
            } else {
                this.metaService.removeTag("property='og:description'")
            }

            if (data.ogImage) {
                this.metaService.updateTag({ property: 'og:image', content: data.ogImage })
            } else {
                this.metaService.removeTag("property='og:image'")
            }


        })

        })
    }
    getChild(activatedRoute: ActivatedRoute) {
        if (activatedRoute.firstChild) {
          return this.getChild(activatedRoute.firstChild);
      } else {
          return activatedRoute;
      }
  }
  /* Set Metas */


  /* Search Pipe */
  @Pipe({
      name: 'search',
      pure: true
  })
  export class SearchPipe implements PipeTransform {

      transform(articles: ArticleModel[], ...args: any[]): any {
        if (!articles && !args) {
          return articles;
      }

      const keyword = args[0];
      return articles.filter((article: ArticleModel) =>
          article.title.indexOf(keyword) !== -1);
  }

}
/* Search Pipe */


currentUser = new BehaviorSubject(false);
this.currentUser.next(this.getUser()); // this.currentUser.next(false)


<p class="text-justify lead text-muted">
{{ article.desc | slice:0:100 }} ...
</p>


getArticles() {
        /////////// single route ///////////
        let id: number;
        id = +this.route.snapshot.paramMap.get('id');
        this.api.getArticles(id).subscribe(res => {
            this.pager = this.pagerservice.getPager(res.total, res.current_page, res.per_page);
            this.articles = res.data;
            console.log(res);
        });

        /////////// reuse route ///////////
        this.activateroute.params.pipe
        (map((params: Params) => params.id))
        .subscribe(id => this.api.getArticles(id)
            .subscribe(res => {
                this.articles = res.data;
                this.loaded = true;
                this.pager = this.pagerservice.getPager(res.total, res.current_page, res.per_page);
            }));

        this.articles = [];

    }



    canDeactivate(): Observable<boolean> | boolean {
        if (this.title == undefined && this.desc == undefined &&
          this.image == undefined && this.category_id == undefined){
          return true;
  } else{
      if( this.title !==this.article.title || this.desc !==this.article.desc
        || this.image !==this.article.image || this.category_id !== this.article.category_id
        ) {

        if(this.editPressed == false){
          return window.confirm('تغییرات ذخیره نشوند?');
      }else {
          return true;
      }
  }
}
}


del(id: number, title: string) {
    const dialog = this.dialog.open(DeleteDialogComponent, {
      width: '348px',
      data: { entityName: 'پاک کردن', message: `پاک شود؟ ${title} مفاله` }
  });
    dialog.afterClosed().subscribe(res => {
      if (res !== undefined) {
        this.api.deleteArticle(id)
        .subscribe(() => location.reload());
        this.openSnackbar();
    }
});

}