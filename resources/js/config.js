var api_url ='';
console.log(process.env.NODE_ENV)
switch( process.env.NODE_ENV ){

    case 'development':
        api_url = 'http://blog.test/api/v1';
        break;
    case 'production':
        api_url = 'https://pltrue.top/api/v1';
        break;
}

export const ROAST_CONFIG = {
    API_URL: api_url,
}
