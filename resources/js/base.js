fRouter.url = function() {
  var result = fRouter.base;
  for(var i = 0; i < arguments.length; ++i) {
    result += arguments[i] + '/';
  }
  return result;
}

fRouter.push = function() {
  var result = fRouter.self;
  for(var i = 0; i < arguments.length; ++i) {
    result += arguments[i] + '/';
  }
  return result;
}

fRouter.pop = function(count) {
  var parse = fRouter.self.split('/');
  for(var i = 0; i <= count; ++i) {
    parse.pop()
  }
  return parse.join('/') + '/';
}