index.js <===>
global.asyncErrorHandler = function (f) {
  return async (req, res, next) => {
    try {
      await f(req, res, next);
    } catch (e) {
      if (dev) {
        res.status(500).send(e.message + "\n" + e.stack);
      } else {
        res.status(500).send(e.message);
      }
    }
  }
};

global.Auth = require('./rpc/endpoints/auth/index');

global.parseOffsetLimit = function (req) {
  const offset = Number.parseInt(req.query.offset || '0');
  const limit = Number.parseInt(req.query.limit || '20');

  return { offset, limit };
};
------------------
class Auth {
  static async listUsers(offset, limit, data) {
    const { role, username } = data;

    let roleFilter = '';
    let usernameFilter = '';

    if (role) {
      roleFilter = `FILTER user.role == "${role}"`;
    }

    if (username) {
      usernameFilter = `FILTER user.username == "${username}"`;
    }

    const cursor = await db.query(`
      FOR user IN users
        ${roleFilter}
        ${usernameFilter}
        LIMIT ${offset}, ${limit}
      RETURN user
    `);

    return {
      count: 999999999,
      result: await cursor.all(),
    };
  }
}
------------------
group.get("/users", asyncErrorHandler(async (req, res) => {
}));

await Auth.sessionAccess(req, 'admin');

const { offset, limit } = parseOffsetLimit(req);

  res.json(await Auth.listUsers(offset, limit, {
    role: req.query.role,
    username: req.query.username,
  }));
  
  group.delete("/sessions", asyncErrorHandler(async (req, res) => {
  res.cookie('sid', '', { expires: new Date(Date.now()) }).end();
}));

group.post("/sessions", validator.body(Joi.object({
  username: Joi.string().required(),
  password: Joi.string().required(),
})), asyncErrorHandler(async (req, res) => {
  const sid = await Auth.login(req.body.username, req.body.password);
  res.cookie('sid', sid, {
    expires: new Date(Date.now() + 90 * 24 * 3600000) // cookie will be removed after 90 days
  }).json(sid);
}));

group.get("/:categoryId", asyncErrorHandler(async (req, res) => {
  res.json(await Category.getCategory(req.params.categoryId));
}));

if (req.body instanceof Array) {
    await Crawler.bulkCreateProduct(req.params.site_id, req.params.log_id, req.body);
  } else {
    await Crawler.bulkCreateProduct(req.params.site_id, req.params.log_id, [req.body.product]);
  }
  
  
// runs every hour
new CronJob('00 00 * * * *', async () => {
  await Currency.crawlAndStoreChineseYuanMS();
}, null, true, 'Asia/Tehran').start();
Currency.crawlAndStoreChineseYuanMS();


    const parsedMeta = JSON.parse(req.body.meta || '{}');
    const { originalname, size, mimetype, path } = file;
	
	
	
static async listRootCategories(offset, limit) {
    const cacheKey = `listRootCategories:${offset}:${limit}`;
    const cachedResult = cache.get(cacheKey);
    if (cachedResult) {
      return cachedResult;
    }

    const cursor = await db.query(`
      FOR c IN categories
        FILTER c.parent == NULL
        SORT c._key DESC
        ${limit ? `LIMIT ${offset}, ${limit}` : ''}
        RETURN c
    `);

    const result = await cursor.all();

    cache.set(cacheKey, result, 8 * 60);

    return result;
}

const sanitized_search_phrase = dbSanitizeString(getNormSearch(search_phrase));
  const tokens = sanitized_search_phrase
    .replace(/[\-_%]/g, ' ')
    .replace(/[\s]{1,}/g, ' ')
    .split(' ')
    .filter(w => w.length > 1);
	
	
	if (typeof native_attributes == 'string') {
      native_attributes = JSON.parse(native_attributes);
    }
	
	const isArray = productId instanceof Array;
	
	
	static getAttributesMap(attributes) {
    const m = new Map();

    attributes.forEach(attr => m.set(attr.key, attr));

    return m;
  }
  
  
  
  /* The unshift() method adds new items to the beginning of an array, and returns the new length.
  Note: This method changes the length of an array. Tip: To add new items at the end of an array,
  use the push() method */
      catStack.unshift(tmpCat);

static async createUserReport(data) {
    return await usersFormsCollection.save({ ...data, type: 'report', date: Date.now() });
  }
  
  // schema
<script type="application/ld+json">
        {
            "@context": "https://schema.org/",
            "@type": "Product",
            "name": "<%= product.name %>",
            "image": <%- JSON.stringify(product.media_list || []) %>,
            "description": "<%- product.desc || '' %>",
            "sku": "<%- sku %>",
            "offers": {
                "@type": "Offer",
                "url": "<%- fullUrl %>",
                "priceCurrency": "IRT",
                "price": "<%- product.price || 0 %>",
                "priceValidUntil": "<%- d_3month_later %>",
                "availability": "<%- product.InStock ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' %>"
            }
        }
    </script>