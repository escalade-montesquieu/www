<?php

const REGEX_LAST_MENTION_IN_STRING = '/@([\w-]*)$/';
const REGEX_MENTIONS_IN_STRING = '/@([\w-]*)/';
const REGEX_MENTION_UUID_FORMAT = "/@([0-9a-fA-F]{8}\-[0-9a-fA-F]{4}\-[0-9a-fA-F]{4}\-[0-9a-fA-F]{4}\-[0-9a-fA-F]{12})/";
const REGEX_MENTION_SPECIAL = "/@(tous)/";
const REGEX_URL = "/(((http|https|ftp|ftps)\:\/\/)|(www\.))[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[0-9]+)?(\/\S*)?/";
